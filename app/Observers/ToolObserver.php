<?php

namespace App\Observers;

use App\Models\Tool;
use App\Models\Log;

class ToolObserver
{
    /**
     * Handle the Tool "created" event.
     *
     * @param  \App\Models\Tool  $tool
     * @return void
     */
    public function created(Tool $tool)
    {
        Log::create([
            'module' => 'tambah alat',
            'action' => 'tambah alat '.$tool->resep_idresep.' dengan nama alat '.$tool->nama_alat,
            'useraccess' => ''
        ]);
    }

    /**
     * Handle the Tool "updated" event.
     *
     * @param  \App\Models\Tool  $tool
     * @return void
     */
    public function updated(Tool $tool)
    {
        Log::create([
            'module' => 'sunting alat',
            'action' => 'sunting alat '.$tool->resep_idresep.' dengan nama alat '.$tool->nama_alat,
            'useraccess' => ''
        ]);
    }

    /**
     * Handle the Tool "deleted" event.
     *
     * @param  \App\Models\Tool  $tool
     * @return void
     */
    public function deleted(Tool $tool)
    {
        Log::create([
            'module' => 'hapus alat',
            'action' => 'hapus alat '.$tool->resep_idresep.' dengan nama alat '.$tool->nama_alat,
            'useraccess' => ''
        ]);
    }

    /**
     * Handle the Tool "restored" event.
     *
     * @param  \App\Models\Tool  $tool
     * @return void
     */
    public function restored(Tool $tool)
    {
        //
    }

    /**
     * Handle the Tool "force deleted" event.
     *
     * @param  \App\Models\Tool  $tool
     * @return void
     */
    public function forceDeleted(Tool $tool)
    {
        //
    }
}
