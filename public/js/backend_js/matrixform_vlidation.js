
$(document).ready(function(){
    
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input type="text" name="sku[]" id="sku" placeholder="SKU" style="width:120px; margin-right:4px; margin-top:4px;"/><input type="text" name="color[]" id="color" placeholder="color" style="width:120px; margin-right:4px; margin-top:4px;"/><input type="text" name="price[]" id="price" placeholder="Price" style="width:120px; margin-right:4px; margin-top:4px;"/><input type="text" name="stock[]" id="stock" placeholder="Stock" style="width:120px; margin-right:4px; margin-top:4px;"/><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

});
