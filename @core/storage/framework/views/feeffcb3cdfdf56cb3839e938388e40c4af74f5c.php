<?php
   use App\ServiceCity;
    $all_cities = ServiceCity::where("status", 1)->get();
    
?>



<?php if(Auth::guard('web')->check()): ?>
<div class="selectingstyle">
    <select  name="overallcity" >
        <option  value="" ><?php echo e(Session::get('cityname') ?: 'Select City'); ?></option>
     
      <?php $__currentLoopData = $all_cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
      <option value=<?php echo e($cities->id); ?> > <?php echo e($cities->service_city); ?> </option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    
</div>

  
<div class="login-account">
    <li>
        <div class="info-bar-item-two">
            <div class="author-thumb">
                <?php if(!empty(Auth::guard('web')->user()->image)): ?>
                    <?php echo render_image_markup_by_attachment_id(Auth::guard('web')->user()->image); ?>

                <?php else: ?>
                    <img src="<?php echo e(asset('assets/frontend/img/static/user_profile.png')); ?>" alt="No Image">
                <?php endif; ?>
                
            </div>
             
            <a class="accounts loggedin" style="color: white;"  href="javascript:void(0)">
                <span class="title"> <?php echo e(Auth::guard('web')->user()->name); ?> </span>
            </a>
            <ul class="account-list-item mt-2">
                <li class="list"> 
                    <?php if(Auth::guard('web')->user()->user_type==0): ?>
                    <a href="<?php echo e(route('seller.dashboard')); ?>"> <?php echo e(__('Dashboard')); ?> </a> 
                    <?php else: ?> 
                    <a href="<?php echo e(route('buyer.dashboard')); ?>"> <?php echo e(__('Dashboard')); ?> </a> 
                    <?php endif; ?>
                </li>
                <li class="list"> <a href="<?php echo e(route('seller.logout')); ?>"> <?php echo e(__('Logout')); ?> </a> </li>
            </ul>
        </div>
    </li>
</div>
<?php else: ?>
     


<div class="selectingstyle">
    <select  name="overallcity" >
        <option  value="" ><?php echo e(Session::get('cityname') ?: 'Select City'); ?></option>
     
      <?php $__currentLoopData = $all_cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
      <option value=<?php echo e($cities->id); ?> > <?php echo e($cities->service_city); ?> </option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    
</div>



    <div class="login-account" >

        <a class="accounts" style="color: rgb(255, 255, 255);" href="javascript:void(0)"> <span class="account"><?php echo e(__('Account')); ?></span> <i class="las la-user"></i> </a>
        <ul class="account-list-item mt-2">
            <li class="list"> <a href="<?php echo e(route('user.register')); ?>"> <?php echo e(__('Register')); ?> </a> </li>
            <li class="list"> <a href="<?php echo e(route('user.login')); ?>"><?php echo e(__('Sign In')); ?> </a> </li>
        </ul>
    </div>
<?php endif; ?>

<style>

.selectingstyle{
    position: relative;
    right: 23px;
}

/* Smartphones */
@media (max-width: 767px) {
  /* CSS styles for smartphones and small mobile devices */
  .selectingstyle{
    width: 97px;
    left: 194px;
    top: -42px;
}
}


/* Tablets */
@media (min-width: 768px) and (max-width: 991px) {
  /* CSS styles for tablets */
  .selectingstyle{
   position: relative;
    left: 579px;
    
    top: -44px;
    width: 100px;
}

}

</style>


<?php $__env->startSection('scripts'); ?>

<script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    <script>
        (function($){
            "use strict";

         
        
            $(document).ready(function() {
        $("select[name='overallcity']").change(function() {
            var selectedValue = $(this).val();
            if (selectedValue) {
   
                $.ajax({
                url: "<?php echo e(route('storeData')); ?>",
                type: "POST",
                data: {
                    '_token': '<?php echo e(csrf_token()); ?>',
                    'data': selectedValue
                },
                success: function(response) {
                    console.log(response.message);
					window.location.href = window.location.href;
                }


            });
            
            }
        });
        });

        


             
            
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?><?php /**PATH C:\xampp\htdocs\Bookmee\@core\resources\views/components/frontend/user-menu.blade.php ENDPATH**/ ?>