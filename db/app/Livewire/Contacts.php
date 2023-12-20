<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contact;

class Contacts extends Component
{
    public $contacts;
    public $contact;
    public $modalFormVisible = false;

    public function render()
    {
        //$this->contacts = Contact::all();
        return view('contacts.index');

    }

    public function create()
    {
        $this->resetForm();
        $this->openModal();
    }

    public function edit($id)
    {
        $this->contact = Contact::find($id);
        $this->openModal();
    }

    public function store()
    {
        // Validation logic here

        Contact::create([
            'name' => $this->contact['name'],
            // Add other fields here
        ]);

        $this->closeModal();
        $this->resetForm();
    }

    public function update()
    {
        // Validation logic here

        $this->contact->update([
            'name' => $this->contact['name'],
            // Update other fields here
        ]);

        $this->closeModal();
        $this->resetForm();
    }

    public function delete($id)
    {
        Contact::destroy($id);
    }

    private function resetForm()
    {
        $this->contact = [];
    }

    public function openModal()
    {
        $this->modalFormVisible = true;
    }

    public function closeModal()
    {
        $this->modalFormVisible = false;
    }
}
