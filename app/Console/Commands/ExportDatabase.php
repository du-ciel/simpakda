<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExportDatabase extends Command
{
    protected $signature = 'db:export {filename?}';

    protected $description = 'Export database to SQL file';

    public function handle(): int
    {
        $filename = $this->argument('filename') ?? database_path('simpakda.sql');
        $fp = fopen($filename, 'w');

        if (! $fp) {
            $this->error("Gagal membuka atau membuat berkas: {$filename}");

            return Command::FAILURE;
        }

        $this->info("Exporting to: {$filename}");

        fwrite($fp, "-- Simpakda Database Export\n");
        fwrite($fp, '-- Date: '.date('Y-m-d H:i:s')."\n\n");

        $driver = DB::getDriverName();
        $skipTables = ['cache', 'cache_locks', 'sessions', 'jobs', 'job_batches', 'failed_jobs'];

        if ($driver === 'sqlite') {
            $tablesData = DB::select("SELECT name, sql FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
            foreach ($tablesData as $t) {
                $table = $t->name;

                if (in_array($table, $skipTables, true)) {
                    continue;
                }

                $this->line("Exporting table: {$table}");

                fwrite($fp, "DROP TABLE IF EXISTS `{$table}`;\n");
                fwrite($fp, $t->sql.";\n\n");

                $rows = DB::table($table)->get();
                if ($rows->isEmpty()) {
                    continue;
                }

                $cols = array_keys((array) $rows->first());
                $insert = "INSERT INTO `{$table}` (`".implode('`, `', $cols)."`) VALUES\n";
                $values = [];

                foreach ($rows as $row) {
                    $vals = [];
                    foreach ((array) $row as $v) {
                        if ($v === null) {
                            $vals[] = 'NULL';
                        } elseif (is_numeric($v) && ! is_string($v)) {
                            $vals[] = $v;
                        } else {
                            $vals[] = "'".addslashes((string) $v)."'";
                        }
                    }
                    $values[] = '('.implode(', ', $vals).')';
                }

                $chunkSize = 50;
                $chunks = array_chunk($values, $chunkSize);
                foreach ($chunks as $chunk) {
                    fwrite($fp, $insert.implode(",\n", $chunk).";\n\n");
                }
            }
        } else {
            $tables = DB::select('SHOW TABLES');

            foreach ($tables as $t) {
                $table = array_values((array) $t)[0];

                if (in_array($table, $skipTables, true)) {
                    continue;
                }

                $this->line("Exporting table: {$table}");

                // Drop & Create
                fwrite($fp, "DROP TABLE IF EXISTS `{$table}`;\n");
                $create = DB::selectOne("SHOW CREATE TABLE `{$table}`");
                $createSql = array_values((array) $create)[1];
                fwrite($fp, $createSql.";\n\n");

                // Data
                $rows = DB::table($table)->get();
                if ($rows->isEmpty()) {
                    continue;
                }

                $cols = array_keys((array) $rows->first());
                $insert = "INSERT INTO `{$table}` (`".implode('`, `', $cols)."`) VALUES\n";
                $values = [];

                foreach ($rows as $row) {
                    $vals = [];
                    foreach ((array) $row as $v) {
                        if ($v === null) {
                            $vals[] = 'NULL';
                        } elseif (is_numeric($v) && ! is_string($v)) {
                            $vals[] = $v;
                        } else {
                            $vals[] = "'".addslashes((string) $v)."'";
                        }
                    }
                    $values[] = '('.implode(', ', $vals).')';
                }

                $chunkSize = 50;
                $chunks = array_chunk($values, $chunkSize);
                foreach ($chunks as $chunk) {
                    fwrite($fp, $insert.implode(",\n", $chunk).";\n\n");
                }
            }
        }

        fclose($fp);
        $this->info('Export complete!');

        return Command::SUCCESS;
    }
}
