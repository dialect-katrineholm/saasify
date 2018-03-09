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
  
  //Change the variables using the helper functions
  $model = saasify()->model()->setModel(\App\Model::class)->setMaxCount(100);
  
  //Use the save-fuction to save or update a component
  $plan = saasify()->plan()->setName('foo')->save();
  
  ## Retrieve component ##
  $module = saasify()->modules()->find('foobar');
  $modules = saasify()->modules()->all();
  //you can also use queries
  $plans = saasify()->plans(function($query){
     return $query->where('price', '>', 10);
  })->get();
  
  ## Relations ##
  
  //to add a relaiton use the add-functions
  $plan = saasify()->plan()->setName('foo')->save();
  $module = saasify()->module()->setName('bar')->save();
  $plan->addModule($module);
  

```


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

