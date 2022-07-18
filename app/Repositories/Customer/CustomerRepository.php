<?php
namespace App\Repositories\Customer;
use App\User;
use App\Repositories\Crud\CrudRepository;
use Mail;
class CustomerRepository extends CrudRepository implements CustomerInterface{
	public function __construct(User $user){
		$this->model=$user;
	}
	public function create($input){
		$this->model->create($input);
	}
	public function update($input,$id){
		$event=$this->model->find($id);
		$value=$input;
		if($value['customerid']!==$event['customerid']){
			$value['customerid']=str_slug($input['customerid']);
		}
		$this->model->find($id)->update($value);
	}
	public function changeStatus($id,$status){
		$client=$this->model->find($id);
		if($status==1){
			$data = array('email' => $client->email,'name'=>$client->name);
        	/*sending mail by user to admin*/
	        Mail::send('email.activationTemplate', $data, function ($message) use ($data) {
	            $message->to($data['email'])->from('info@srijanasutra.com','Srijana Sutra');
	            $message->subject('thank u for registering');
	        });
		}
		$client->publish=$status;
		$client->new=0;
		$client->save();
		return;
	}
	public function approveCustomer($id){
		$client=$this->model->find($id);
		$client->publish='approved';
		$client->new=0;
		$client->save();

	}
	public function rejectCustomer($id){
		$client=$this->model->find($id);
		$client->publish='rejected';
		$client->new=0;
		$client->save();

	}
}