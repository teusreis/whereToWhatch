<?php

namespace App\Http\Livewire;

use App\Services\SiteService;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropDown extends Component
{
    public string $search;
    public $results;

    public function mount()
    {
        $this->search = "";
        $this->results = [];
    }

    public function updatedSearch()
    {
        if (strlen($this->search) === 0) {
            $this->results = [];
            return;
        }

        $results = collect(app(SiteService::class)->search($this->search))
            ->filter(function ($movshow) {
                return $movshow['media_type'] === 'movie' || $movshow['media_type'] === 'tv';
            });

        $results->sortBy('popularity');

        $this->results = $results;
    }

    public function goToSearch()
    {
        if (strlen($this->search) === 0) {
            $this->results = [];
            return;
        } else {
            return redirect()
                ->route('site.index', [
                    'search' => $this->search
                ]);
        }
    }

    public function render()
    {
        return view('livewire.search-drop-down');
    }
}
