# saasify

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

TODO

## Usage

### Components
 #### Plan
   ###### Variables
    name
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

 ##Basic usage##
 //You can use the saasify-helper to create components
  $plan = saasify()->plan();
  $model = saasify()->module();
  $model = saasify()->plan();
  
  //Change the variables using the helper functions
  $model = saasify()->model()->setModel(\App\Model::class)->setMaxCount(100);
  
  //Use the save-fuction to save or update a component
  $plan = saasify()->plan()->setName('foo')->save();
  
  ##Relations##
  

```


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

