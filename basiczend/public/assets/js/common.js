var domain = document.domain;
var publicPath = "http://" + domain + "/index.php/";


$().ready(function () {
    if (jQuery("#changepassword").length > 0) {

        jQuery.validator.addMethod("noSpace", function (value, element) {
            return value.indexOf(" ") < 0 && value != "";
        }, "No space please and don't leave it empty");
        // validate user form on keyup and submit
        $("#changepassword").validate({
            rules: {
                user_password: {
                    required: true,
                    minlength: 5,
                    noSpace: true
                },
                conf_user_password: {
                    required: true,
                    minlength: 5,
                    noSpace: true,
                    equalTo: "#user_password"
                },
                agree: "required"
            },
            messages: {
                user_password: {
                    required: "Please enter a password",
                    minlength: "Your password must be at least 5 characters long",
                    noSpace: "No space allowed in password"
                },
                conf_user_password: {
                    required: "Password does not match.",
                    minlength: "Your confirm password must be at least 5 characters long",
                    equalTo: "Password does not match."
                }
            }

        });
    }

    if (jQuery("#login").length > 0) {

        jQuery.validator.addMethod("noSpace", function (value, element) {
            return value.indexOf(" ") < 0 && value != "";
        }, "No space please and don't leave it empty");
        // validate user form on keyup and submit
        $("#login").validate({
            rules: {
                user_email: {
                    required: true,
                    email: true,
                    noSpace: true
                },
                user_password: {
                    required: true,
                    noSpace: true
                },
                agree: "required"
            },
            messages: {
                user_email: "Please enter a valid email address",
                user_password: {
                    required: "Please enter a password",
                    noSpace: "No space allowed in password"
                }
            }
        });
        //});
    }

    /* user create and edit form validation*/
    if (jQuery("#userform").length > 0) { // alert("oin");

        jQuery.validator.addMethod("noSpace", function (value, element) {
            return value.indexOf(" ") < 0 && value != "";
        }, "No space please and don't leave it empty");
        // validate user form on keyup and submit
        $("#userform").validate({
            rules: {
                user_role_id: {
                    required: true
                },
                user_fname: {
                    required: true,
                    noSpace: true
                },
                user_email: {
                    required: true,
                    email: true,
                    noSpace: true
                },
                user_password: {
                    required: true,
                    noSpace: true,
                    // min:5
                },
                agree: "required"
            },
            messages: {
                user_email: "Please enter a valid email address",
                user_role_id: {
                    required: "Please select user role"
                },
                user_fname: {
                    required: "Please enter a firstname",
                    noSpace: "No space allowed in firstname"
                },
                user_password: {
                    required: "Please enter a password",
                    noSpace: "No space allowed in password",
                    min: "minimum 5 characters required"
                }
            }
        });

    }

    /* File upload*/
    if (jQuery("#importForm").length > 0) {
       
            jQuery.validator.addMethod("noSpace", function(value, element) {
                return value.indexOf(" ") < 0 && value != "";
            }, "No space please and don't leave it empty");
            // validate user form on keyup and submit
            $("#importForm").validate({
                rules: {                   
                    importFileName: {
                        required: true,
                        maxlength: 14,
                        noSpace: true
                    },
                    csv_file: {
                        required: true                       
                    },
                    agree: "required"
                },
                messages: {                   
                    importFileName: {
                        required: "Please enter a file name",
                        maxlength: "Maximum 14 characters only",
                        noSpace: "No space allowed in file name"
                    },
                    csv_file: {
                       required: "Please select csv file."
                    }
                }
            });
       
    }

    /* $("#reset").click(function(){ alert("in");
         $("#user_role_id").val('');
         $("#status").val('');
         $("#searchKey").val('');
         $("#searchForm").submit();
         alert("no");
    });
       */

    //alert("in");
});