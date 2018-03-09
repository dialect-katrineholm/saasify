# saasify

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

TODO

## Usage

### Components
 #### Plan
   ###### Variables
    name, price
   ###### Relations
    modules
  
  #### Module
   ###### Variables
    name
   ###### Relations
    plans, models
   
  #### Model
   ###### Variables
    model, module, canCreate, canUpdate, canDelete, maxCount
   ###### Relations
    module

  
### Examples

``` php

 ## Save / Update ##
 
  //You can use the saasify-helper to create components
  $plan = saasify()->plan();
  $model = saasify()->module();
  $model = saasify()->plan();
  
  //Change the variables using the helper methods
  $model = saasify()->model()->setModel(\App\Model::class)->setMaxCount(100);
  
  //Use the save-method to save or update a component
  $plan = saasify()->plan()->setName('foo')->save();
  
  //use the delete-function to remove component
  $plan->delete();
  
  ## Retrieve component ##
  
   $module = saasify()->modules()->find('foobar');
   $modules = saasify()->modules()->all();
   
   //It's also possible to use queries
   $plans = saasify()->plans(function($query){
      return $query->where('price', '>', 10);
   })->get();
   
   //The component-builders also supports
   saasify()->modules()->count();
   saasify()->modules()->first();
   
  
  ## Relations ##
  
   //to add a relaiton use the add-method
   $plan = saasify()->plan()->setName('foo')->save();
   $module = saasify()->module()->setName('bar')->save();
   $plan->addModule($module);
   
   //or remove using the remove-method
   $plan->removeModule($module)
  
   //As of now, you need to set the module on a model before its saved.
   $model = saasify()->model()
                     ->setModel(\App\Model::class)
                     ->setModule($module);
                     
                     
  ## Access ## 
  
  //Add the trait HasPlans to the Laravel model that should have plans
  class User extends Model{
	   use HasPlans;
  }
  
  //this gives acceess to new method
  $user->canAccess(FooBar::class);
  $user->canAccess($fooBar);
  $user->canUpdate(..);
  $user->canDelete(..);
  $user->getCount(..);
  
  //for saasify to know how many instances of a model a user has,
  //add the saasify helper method to the model with the required logic for counting.
  class User extends Model{
	  public static function saasifyCurrent($user){
	    //logic here, example:
	    return $user->foobar()->count();
	  }
  }
  
  
```


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

