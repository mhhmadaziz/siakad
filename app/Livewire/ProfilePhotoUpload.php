<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfilePhotoUpload extends Component
{

    use WithFileUploads;

    public User $user;

    #[Validate('image')]
    public $photo;

    public function updatedPhoto()
    {
        $this->validate();

        try {
            DB::transaction(function () {

                if ($this->user->photo) {
                    Storage::disk('public')->delete('profile-photos/' . $this->user->photo);
                }

                $fileName = $this->photo->hashName();

                $this->user->update([
                    'photo' => $fileName,
                ]);

                Storage::disk('public')->putFileAs('profile-photos', $this->photo, $fileName);
                $this->photo = null;

                session()->flash('success', 'Photo profile berhasil diupload');
            });
        } catch (\Throwable $th) {

            session()->flash('error', 'Terjadi kesalahan saat mengupload photo profile ' . $th);
        }
    }

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.profile-photo-upload');
    }
}
