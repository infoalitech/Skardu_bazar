<?php
/**
 * 
 */
namespace App\Services\Commons;
use App\Repositories\Commons\UserRepository;
class UserService
{
	protected $userRepository;
	function __construct(UserRepository $userRepository)
	{
		$this->userRepository=$userRepository;
	}
	public function getAllUsers()
	{
		return $this->userRepository->getAllUsers();
	}
	public function getUser($id)
	{
		return $this->userRepository->getUser($id);
	}
	public function storeUser($request)
	{
		return $this->userRepository->storeUser($request);
	}
	public function updateUser($id,$request)
	{
		return $this->userRepository->updateUser($id,$request);
	}
	public function deleteUser($id)
	{
		return $this->userRepository->deleteUser($id);
	}
}