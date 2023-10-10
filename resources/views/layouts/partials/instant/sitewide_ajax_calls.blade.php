
<script type="text/javascript">

    document.addEventListener('DOMContentLoaded', function () {
        selectAllCheckboxes()
        addIdToMessagePopUp();
        sendMessageToReceiptent();
        sendConnnectionRequest();
        deleteAllSelected();
    });

    function addIdToMessagePopUp(){
        $('.send_message').on('click', function(){
            $('#recipient_id').val($(this).attr('data-id'));
        });
    }

    function sendMessageToReceiptent(){

        $(document).on('click', '.sendMessageRecipient', function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var message = $("#messageSubject").val();
            var title   = $("#messageTitle").val();
            var recipient_id = $('#send_message_panel').find('input[name="recipient_id"]').val();

            //   alert(message + title  + recipient_id);

            $('#send_message_panel').fadeOut();
            $("#overlay").fadeIn(300);

            $.ajax({
                url:"{{ route('messages.save.message') }}",
                type:"POST",
                data:{
                    title:title,
                    message:message,
                    recipient_id:recipient_id
                },
                success:function(response){

                    $("#overlay").fadeOut();

                    if (response.status == true) {



                        //  $('body').find('.price-section').append(data.html);
                    } else {
                        //  toastr.error(data.message);
                    }

                    /*  $('#send_message_panel').fadeOut();
                      console.log('received this response: '+response);

                   //   alert('works');
                      //  location.reload(true);
                  //    console.log(response);
                      if(response) {
                          $('.success').text(response.success);
                          //   $("#ajaxform")[0].reset();
                         // location.reload();
                      }*/
                },
            });
        })
    }

    function sendConnnectionRequest(){

        $(document).on('click', ".sendHeart,.addToFavourites,.blockMember", function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var recipientId = ($(this).attr('data-id'));

            alert(recipientId);

            if($(this).attr('data-parent') == "blockMember"){

                var check = confirm("Are You Sure You Want To Block Member ?");

                if(!check){
                    xhr.abort();
                }
            }

            $.ajax({
                url: $(this).data('url'),
                type:"POST",
                data:{
                    id:($(this).attr('data-id'))
                },
                success:function(response){

                    //      alert('works');
                    console.log(response);
                    if(response) {
                        $('.success').text(response.success);
                        //   $("#ajaxform")[0].reset();
                    }
                },
            });

        });
    }

    function XselectAllCheckboxes() {

        $('#master').on('click', function (e) {
            if ($(this).is(':checked', true)) {
                $(".form-check-input").prop('checked', true);
            } else {
                $(".form-check-input").prop('checked', false);
            }
        });
    }

    function selectAllCheckboxes() {

        $(document).ready(function () {
            $("#master").on("click", function () {
                $(".forms-check-input").each(function () {
                    $(this).prop("checked", !$(this).prop("checked"));
                });
            });
        });
    }

    function deleteAllSelected() {

        $(document).ready(function () {

            $('#delete_all').on('click', function (e) {
                var allVals = [];

                alert('arrived right palce');

                $(".forms-check-input:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });

                alert(allVals);

                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {
                    var check = confirm("Are you sure you want to delete this row?");

                    if (check == true) {

                        var join_selected_values = allVals.join(",")

                        $.ajax({
                            url: $(this).data('url'),
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids=' + join_selected_values,

                            success: function (data) {

                                if (data['success']) {

                                    $(".form-check-input:checked").each(function () {

                                        $(this).parents("tr").remove();

                                    });
                                    location.reload(true);

                                    alert(data['success']);

                                } else if (data['error']) {

                                    alert(data['error']);

                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },

                            error: function (data) {

                                alert(data.responseText);
                            }
                        });

                        $.each(allVals, function (index, value) {

                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });
                    }
                }
            });
        });
    }

    function regFormValidation(){
        $(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                    alert( "Form successful submitted!" );
                }
            });
            $('#quickForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    terms: {
                        required: true
                    },
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    }

    function XdeleteAllSelected() {

        alert('arrived');

        $('#delete_all').on('click', function(e) {
            var allVals = [];

            alert('arrived');

            $("form-check-input:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });

            alert(allVals);

            if(allVals.length <=0)
            {
                alert("Please select row.");
            } else {
                var check = confirm("Are you sure you want to delete this row?");

                if(check == true){

                    var join_selected_values = allVals.join(",")

                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,

                        success: function (data) {

                            if (data['success']) {

                                $(".form-check-input:checked").each(function() {

                                    $(this).parents("tr").remove();

                                });
                                location.reload(true);

                                alert(data['success']);

                            } else if (data['error']) {

                                alert(data['error']);

                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },

                        error: function (data) {

                            alert(data.responseText);
                        }
                    });

                    $.each(allVals, function( index, value ) {

                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
                }
            }
        });
    }

</script>
