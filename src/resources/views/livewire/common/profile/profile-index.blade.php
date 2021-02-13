<div>
	<x-flash-message />
    <div class="row justify-content-center">
    	<div class="profile col-md-4 ">
            <div class=" overflow-hidden shadow-xl sm:rounded-lg py-4 px-4 m-2" style="color:white; background-color: #2E5840;">
	    		<img src="{{ asset('$user->image')}}">

	    		<h3 class="text-center">{{ucfirst(trans($user->name))}}</h3>
	    		<h4 class="text-center">{{$user->email}}</h4>
	    		<hr>
	    		<div class="text-center">
					<button class="btn btn-info px-3" wire:click="updateprofilemodal()">Change Profile</button>
					<button class="btn btn-success px-3" wire:click="updatepasswordmodal()">Change Password</button>
	    		</div>
	    		<hr>
	    			<h5>Rating</h5>
	    		<hr>
	    			<h4>Total Orders</h4>
	    		<hr>
	    			<h4>Pending Orders</h4>
	    		<hr>
	    	</div>
    	</div>
    	<div class="col-md-8 ">
    		<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-4 px-2 m-2">
    			<h5>jkdl	</h5>
	    	</div>
    	</div>
    </div>









<!-- Edit Model -->
	<x-jet-dialog-modal wire:model="editmodal">
		<x-slot name="title">
		    {{ __('Update Password') }}
		</x-slot>
		<x-slot name="content">
			<div>
				<x-jet-label for="oldpassword" value="{{ __('Old Password') }}" />
				<x-jet-input id="oldpassword" type="password" class="mt-1 block w-full" wire:model="old_password"  />
				<x-jet-input-error for="oldpassword" class="mt-2" />
			</div>
			<div>
				<x-jet-label for="newpassword" value="{{ __('New Password') }}" />
				<x-jet-input id="newpassword" type="password" class="mt-1 block w-full" wire:model="new_password"  />
				<x-jet-input-error for="newpassword" class="mt-2" />
			</div>

		</x-slot>
		<x-slot name="footer">
		    <x-jet-secondary-button wire:click="$set('editmodal',false )" wire:loading.attr="disabled">{{ __('Cancel') }}</x-jet-secondary-button>
		    <x-jet-danger-button class="ml-2" wire:click="updatepassword()" wire:loading.attr="disabled">
		        {{ __('Update') }}
		    </x-jet-danger-button>
		</x-slot>
	</x-jet-dialog-modal>


<!-- Edit Model -->
	<x-jet-dialog-modal wire:model="profilemodal">
		<x-slot name="title">
		    {{ __('Update Profile Picture') }}
		</x-slot>
		<x-slot name="content">
			<div>
			    <div class="text-center align-center row">
				    @if ($photo)
				    <div class="col-lg-4 col-md-6">
				    	<img src="{{ $photo->temporaryUrl() }}" class="img img-thumbnail align-center	" width="250px" alt="Profile Picture" style="align-self: center;">
				    </div>
				    @endif
					<x-jet-label for="name" value="{{ __('Profile Picture') }}" />
			    </div>
				<x-jet-input id="file" type="file"  class="mt-1 block w-full" wire:model="photo" />
			    @error('photo') <span class="error">{{ $message }}</span> @enderror
			    <div wire:loading wire:target="photo">Uploading...</div>
			</div>
		</x-slot>
		<x-slot name="footer">
		    <x-jet-secondary-button wire:click="$set('profilemodal',false )" wire:loading.attr="disabled">{{ __('Cancel') }}</x-jet-secondary-button>
		    <x-jet-danger-button class="ml-2" wire:click="updateprofile()" wire:loading.attr="disabled">
		        {{ __('Upload') }}
		    </x-jet-danger-button>
		</x-slot>
	</x-jet-dialog-modal>
</div>


