// @ts-nocheck
$(document).ready(function(){
 
    // get Add data
    $('.btn-add').on('click',function(){
        // Call Modal add
        $('#addModal').modal('show');
    });

    // get Edit data
    $('.btn-edit').on('click',function(){
        const id = $(this).data('id');
        const name = $(this).data('name');
        const magento_id = $(this).data('magento_id');
        $('.id').val(id);
        $('.name').val(name);
        $('.magento_id').val(magento_id);
        // Call Modal Edit
        $('#editModal').modal('show');
    });

    // get Delete data
    $('.btn-delete').on('click',function(){
        const id = $(this).data('id');
        $('.id').val(id);
        // Call Modal delete
        $('#deleteModal').modal('show');
    });
    // include the validation for the form function comes with this plugin
      $('#addForm').validate({
        // set validation rules for input fields
            rules: {
              ID: {
                required: true,
                minlength: 1,
                lettersonly: true
              },
              name: {
                required: true,
              },
              magento_id: {
                required: true,
                number: true
              },
            },
            // set validation messages for the rules are set previously
            messages: {
              name: {
                required: "Please enter name",
              },
              ID: {
                required: "Please enter ID",
                maxlength: "ID should be maximum 2 characters",
              },      
              magento_id: {
                required: "Please enter magento_id",
              },
            },
        });   
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Only alphabets allowed in ID");    
        $('#editForm').validate({
        // set validation rules for input fields
            rules: {
                name: {
                    required: true,
                },
                magento_id: {
                    required: true,
                    number: true
                },
            },
            // set validation messages for the rules are set previously
            messages: {
                name: {
                    required: "Please enter name",
                },   
                magento_id: {
                    required: "Please enter magento_id",
                },
            },
        });           
});