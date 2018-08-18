<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Facades\App\Models\ServiceStatus;

use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\Transition;
use Symfony\Component\Workflow\Workflow;
use Symfony\Component\Workflow\MarkingStore\SingleStateMarkingStore;

class ServiceWorkflow extends Model
{


	public function getServiceStates()
	{
		$serviceStatus = ServiceStatus::all();
		$statusArray = [];


		foreach( $serviceStatus as $status){
			$statusArray[] = $status->code;
		}
		//Store this in database -> show options to users
		return $statusArray;
		//return ['register', 'estimation', 'confirm', 'asignation','process','billing','billed','payed'];
	}

	public function defineServiceWorkflow()
	{
		$definitionBuilder = new DefinitionBuilder();
		
		$definition = $definitionBuilder->addPlaces( $this->getServiceStates() )
    // Transitions are defined with a unique name, an origin place and a destination place
    ->addTransition(new Transition('to_estimate', 'register', 'estimation'))
    ->addTransition(new Transition('to_confirm', 'estimation', 'confirm'))
    ->addTransition(new Transition('to_assign', 'confirm', 'asignation'))
    ->addTransition(new Transition('to_process', 'asignation', 'proccess'))
    ->addTransition(new Transition('to_bill', 'proccess', 'bill'))
    ->addTransition(new Transition('bill', 'bill', 'billed'))
    ->addTransition(new Transition('pay', 'billed', 'payed'))
    ->build();

		$marking = new SingleStateMarkingStore('state');
		$workflow = new Workflow($definition, $marking);

		return $workflow;		
	}


  public function defineWorkflow()
  {
  	$definitionBuilder = new DefinitionBuilder();
		$definition = $definitionBuilder->addPlaces(['draft', 'review', 'rejected', 'published'])
    // Transitions are defined with a unique name, an origin place and a destination place
    ->addTransition(new Transition('to_review', 'draft', 'review'))
    ->addTransition(new Transition('publish', 'review', 'published'))
    ->addTransition(new Transition('reject', 'review', 'rejected'))
    ->build();

		$marking = new SingleStateMarkingStore('currentPlace');
		$workflow = new Workflow($definition, $marking);


		$post = new BlogPost();
		if($workflow->can($post, 'publish')){
			echo "1";
		} 

		$transitions = $workflow->getEnabledTransitions($post);
		foreach( $transitions as $item){
			print_r($item->getName());
			print_r($item->getFroms());
			print_r($item->getTos());
		}

		$workflow->apply($post, 'to_review');

		$transitions = $workflow->getEnabledTransitions($post);
		foreach( $transitions as $item){
			print_r($item->getName());
			print_r($item->getFroms());
			print_r($item->getTos());
		}


  }
}

class BlogPost
{
    // This property is used by the marking store
    public $currentPlace;
    public $title;
    public $content;
}
