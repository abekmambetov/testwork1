<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Laravel</title>
        <script
			  src="https://code.jquery.com/jquery-3.7.1.min.js"
			  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
			  crossorigin="anonymous"></script>
        <style>
        .form-control {
            content: "Browse 123";
        }
        </style>
        
        <script type="text/javascript">
        $( document ).ready(function() {


            $("form").submit(function(e){

                var $fileUpload = $("input[type='file']");
                if (parseInt($fileUpload.get(0).files.length)>5){
                    $("#file-limit-msg").show();
                    e.preventDefault();
                } else {
                    $("#file-limit-msg").hide();
                }
                
            });
 


        });
        </script>
    </head>
    <body>
    
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="mb-3">
        
           <form method="POST" action="<?php echo e(route('save-images')); ?>" enctype="multipart/form-data" multiple="multiple">
               <?php echo csrf_field(); ?>
               <input class="form-control" type="file" name="images[]" multiple="multiple">
               <div style="display: none" id="file-limit-msg">Вы можете отправить до 5 файлов</div>
               <button type="submit" class="btn btn-primary mt-3">Отправить</button>
               
           </form>
        
          
        </div>
    </div>
    
    

    
    
    
    
       upload form

    </body>
</html>
<?php /**PATH /var/www/example-app/resources/views/upload-form.blade.php ENDPATH**/ ?>