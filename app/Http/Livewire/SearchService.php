<?php

namespace App\Http\Livewire;
use App\Models\Service;

use Livewire\Component;

class SearchService extends Component
{
    public $search;


    public function searchService(){
        dd($search);
    }

    public function render()
    {
        
        return view('livewire.search-service', [
            'services' => Service::where('title', 'like', '%'.$this->search.'%')->get(),
        ]);
    }
}
