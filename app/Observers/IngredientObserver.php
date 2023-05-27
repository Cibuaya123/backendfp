<?php

namespace App\Observers;

use App\Models\Ingredient;
use App\Models\Log;

class IngredientObserver
{
    /**
     * Handle the Ingredient "created" event.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return void
     */
    public function created(Ingredient $ingredient)
    {
        Log::create([
            'module' => 'tambah bahan',
            'action' => 'tambah bahan untuk id resep '.$ingredient->resep_idresep.' dengan bahan '.$ingredient->nama,
            'useraccess' => ''
        ]);
    }

    /**
     * Handle the Ingredient "updated" event.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return void
     */
    public function updated(Ingredient $ingredient)
    {
        Log::create([
            'module' => 'sunting bahan',
            'action' => 'sunting bahan untuk id resep '.$ingredient->resep_idresep.' dengan bahan '.$ingredient->nama,
            'useraccess' => ''
        ]);
    }

    /**
     * Handle the Ingredient "deleted" event.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return void
     */
    public function deleted(Ingredient $ingredient)
    {
        Log::create([
            'module' => 'hapus bahan',
            'action' => 'hapus bahan untuk id resep '.$ingredient->resep_idresep.' dengan bahan '.$ingredient->nama,
            'useraccess' => ''
        ]);
    }

    /**
     * Handle the Ingredient "restored" event.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return void
     */
    public function restored(Ingredient $ingredient)
    {
        //
    }

    /**
     * Handle the Ingredient "force deleted" event.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return void
     */
    public function forceDeleted(Ingredient $ingredient)
    {
        //
    }
}
