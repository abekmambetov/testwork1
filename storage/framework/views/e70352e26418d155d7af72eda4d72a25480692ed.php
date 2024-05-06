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
        
        <style>
        .textblock {
            width: 109px; 
            display: inline-table; 
            position: relative;
            left: 0;
            top: 0;
            bottom: 0;
            right: 0;
            margin: auto;
        }
        </style>
        
        <script type="text/javascript">
        $( document ).ready(function() {


            $( "#sort" ).on( "change", function() {
              location.href = '/images?orderBy=' + $(this).val() + '&sort=' +$(this).find(':selected').attr('data-order')
            } );
 
            

        });
        </script>


    </head>
    <body>
    
    <div style="padding: 30px; width: 350px">
        <label>Сортировать по</label>
        <select class="form-select" id="sort" aria-label="Default select example">
          <option selected value="name" data-order="asc">Название а-я</option>
          <option value="name" data-order="desc">Название я-а</option>
          <option value="date" data-order="asc">Дата новые</option>
          <option value="date" data-order="desc">Дата старые</option>
        </select>
    </div>
    
    <div style="padding-left: 30px;">
        <p><a target="_blank" href="/getFile">Скачать архив</a></p>
    </div>
        
    <div style="padding: 30px">
	    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		    <div><img src="/storage/thumb_<?php echo e($item['filename']); ?>" class="rounded float-left mt-2" width="500"></div>
            <div class="textblock">
                <p><?php echo e($item['filename']); ?> <b><?php echo e($item['created_at']); ?></b></p>
                <p><a target="_blank" href="/storage/<?php echo e($item['filename']); ?>">Смотреть оригинал</a></p>
            </div>

		    
	    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
    </body>
</html>
<?php /**PATH /var/www/example-app/resources/views/images-list.blade.php ENDPATH**/ ?>