<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseTable extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';

    public $searchColumns = ['name'];

    public $actionView = '';

    public $numbering = true;

    public $checkbox = false;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public $perPage = 10;

    public abstract function query(): \Illuminate\Database\Eloquent\Builder;

    public abstract function columns(): array;

    #[Computed()]
    public function data()
    {

        $query = $this->query();

        if ($this->search !== '') {
            $query->where(function ($query) {
                foreach ($this->searchColumns as $column) {
                    if (str_contains($column, '.')) {
                        $relationship = explode('.', $column);

                        // get last element of array, then get all element except the last element
                        $lastElement = end($relationship);
                        array_pop($relationship);

                        // gabungkan semua element array yang sudah dihilangkan last element dengan sambungkan dengan titik
                        $relationship = implode('.', $relationship);

                        // cari data yang memiliki relasi dengan table lain
                        $query->orWhereHas($relationship, function ($query) use ($lastElement) {
                            $query->where($lastElement, 'like', '%' . $this->search . '%');
                        });
                    } else {
                        $query->orWhere($column, 'like', '%' . $this->search . '%');
                    }
                }
            });
        }


        return $query
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.base-table');
    }
}
