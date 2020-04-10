<?php

namespace App\Http\Livewire;

use App\Library;
use Livewire\Component;

class Libray extends Component
{
    public $data, $nombre, $precio ,$selected_id;
    public $updateMode = false;

    public function render()
    {
        $this->data = Library::all();
        return view('livewire.libray');
    }


    private function resetInput()
    {
        $this->nombre = null;
        $this->precio = null;
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required|min:5',
            'precio' => 'required|numeric|min:4'
        ]);
        Library::create([
            'nombre' => $this->nombre,
            'precio' => $this->precio
        ]);
        $this->resetInput();

        session()->flash('message', 'libro creado satisfactoriamente.');
    }


    public function destroy($id)
    {
        if ($id) {
            $record = Library::where('id', $id);
            $record->delete();
            session()->flash('delete', 'libro eliminado satisfactoriamente.');
        }
    }

    public function edit($id)
    {
        $record = Library::findOrFail($id);
        $this->selected_id = $id;
        $this->nombre = $record->nombre;
        $this->precio = $record->precio;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'nombre' => 'required|min:5',
            'precio' => 'required|numeric|min:4'
        ]);
        if ($this->selected_id) {
            $record = Library::find($this->selected_id);
            $record->update([
                'nombre' => $this->nombre,
                'precio' => $this->precio
            ]);
            $this->resetInput();
            $this->updateMode = false;

            session()->flash('message', 'libro actualizado satisfactoriamente.');
        }
    }
}
