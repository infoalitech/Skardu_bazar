<?php
/**
 * 
 */
namespace App\Repositories\Commons;

use App\Models\User;
use Livewire\WithPagination;
class UserRepository
{

    use WithPagination;
	protected $user;
	function __construct(User $user)
	{
		$this->user=$user;
	}
	public function getAllUsers()
	{
		$users=User::paginate(1);
		return $users;
	}

	public function getUser(User $user)
	{
		return $user;
	}
	public function storeUser($request)
	{
		$new_user=new User;
		$this->user=$new_user;
	}
	public function updateUser(User $user,$request)
	{
		$this->save();
	}
	public function deleteUser($id)
	{
		$this->delete();
	}
}
