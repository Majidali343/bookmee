
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Order Success')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <title><?php echo e(__('Order Success')); ?></title>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-title'); ?>
    <?php 
    $page_info = request()->url();
    $str = explode("/",request()->url());
    $page_info = $str[count($str)-2];
    ?>  
    <?php echo e(__(ucfirst(str_replace(['-','_'],' ',$page_info)))); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <style>
        .add-to-calendar .icon-google {
            display: block!important;
        }
        .add-to-calendar-checkbox~a:before{
            display:none!important;
        }
    </style>

    <?php $__env->stopSection(); ?>

<?php $__env->startSection('inner-title'); ?>
    <?php echo e(__('Order')); ?>

<?php $__env->stopSection(); ?> 

<?php $__env->startSection('content'); ?>
<style>
    .msform fieldset {
        width: 100%!important;
    }
</style>
   <!-- Location Overview area starts -->
 <section class="location-overview-area padding-top-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form id="msform" class="msform">
                    <!-- Successful Complete -->
                    <fieldset class="padding-top-80 padding-bottom-100">
                        <div class="form-card successful-card">
                            <h2 class="title-step"> <?php echo e(get_static_option('success_title') ?? __('SUCCESSFUL')); ?></h2>
                            <a href="<?php echo e(route('homepage')); ?>" class="succcess-icon">
                                <i class="las la-check"></i>
                            </a>
                            <h5 class="purple-text text-center"><?php echo e(get_static_option('success_subtitle') ?? __('Your Order Successfully Completed')); ?></h5>
                            <div class="btn-wrapper margin-top-35">
                                <h4 class="mb-3"><?php echo e(get_static_option('success_details_title') ?? __('Your Order Details')); ?></h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Date & Schedule')); ?></th>
                                            <th><?php echo e(__('Amount Details')); ?></th>
                                            <th><?php echo e(__('Order Status')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php if(!empty($order_details->date)): ?>
                                                <label><strong><?php echo e(__('Date:')); ?>

                                                    </strong><?php echo e(Carbon\Carbon::parse(strtotime($order_details->date))->format('d/m/y')); ?></label>

                                                    <br>
                                                <?php endif; ?>
                                                <?php if(!empty($order_details->schedule)): ?>
                                                <label><strong><?php echo e(__('Schedule:')); ?> </strong><?php echo e($order_details->schedule); ?></label>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <label><strong><?php echo e(__('Package Fee:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->package_fee)); ?></label> <br>
                                                <?php if($order_details->extra_service >=1): ?>
                                                <label><strong><?php echo e(__('Extra Service:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->extra_service)); ?></label> <br>
                                                <?php endif; ?>
                                                <label><strong><?php echo e(__('Sub Total:')); ?></strong><?php echo e(float_amount_with_currency_symbol($order_details->sub_total)); ?></label> <br>
                                                <label><strong><?php echo e(__('Tax:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->tax)); ?></label> <br>
                                                <?php if(!empty($order_details->coupon_amount)): ?>
                                                    <label><strong><?php echo e(__('Coupon Amount:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->coupon_amount)); ?></label> <br>
                                                <?php endif; ?>
                                                <label><strong><?php echo e(__('Total:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->total)); ?></label> <br>
                                                <label><strong><?php echo e(__('Payment Gateway:')); ?> </strong><?php echo e(__(ucwords(str_replace("_", " ", $order_details->payment_gateway)))); ?></label> <br>
                                                <label><strong><?php echo e(__('Payment Status:')); ?> </strong><?php echo e(__(ucfirst($order_details->payment_status))); ?></label> <br>
                                            </td>
                                            <td>
                                                <label><strong><?php echo e(__('Order Status:')); ?></strong>
                                                    <?php if($order_details->status == 0): ?> <span><?php echo e(__('Pending')); ?></span><?php endif; ?>
                                                    <?php if($order_details->status == 1): ?> <span><?php echo e(__('Active')); ?></span><?php endif; ?>
                                                    <?php if($order_details->status == 2): ?> <span><?php echo e(__('Completed')); ?></span><?php endif; ?>
                                                    <?php if($order_details->status == 3): ?> <span><?php echo e(__('Delivered')); ?></span><?php endif; ?>
                                                    <?php if($order_details->status == 4): ?> <span><?php echo e(__('Cancelled')); ?></span><?php endif; ?>
                                                </label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="btn-wrapper text-center margin-top-35">
                                <a href="<?php echo e(get_static_option('button_url') ?? route('homepage')); ?>" class="cmn-btn btn-bg-1"><?php echo e(get_static_option('button_title') ?? __('Back To Home')); ?></a>
                                <?php if(auth('web')->check()): ?>
                                    <?php
                                    $user_details = auth('web')->user();
                                    $route_prefix = $user_details->user_type === 0 ? 'seller' : 'buyer';
                                    ?>
                                    <a href="<?php echo e(route($route_prefix.'.dashboard')); ?>" class="cmn-btn btn-bg-1"><?php echo e(__('Go To Dashboard')); ?></a>
                                    <a href="<?php echo e(route($route_prefix.'.orders')); ?>" class="cmn-btn btn-bg-1"><?php echo e(__('All Orders')); ?></a>
                                    <div class="cmn-btn btn-bg-1 new-cal"></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Location Overview area end -->
<?php $__env->stopSection(); ?>

<scripts>

    <script>
        ;(function(exports) {
            var MS_IN_MINUTES = 60 * 1000;

            var formatTime = function(date) {
                return date.toISOString().replace(/-|:|\.\d+/g, '');
            };

            var calculateEndTime = function(event) {
                return event.end ?
                    formatTime(event.end) :
                    formatTime(new Date(event.start.getTime() + (event.duration * MS_IN_MINUTES)));
            };

            var calendarGenerators = {
                google: function(event) {
                    var startTime = formatTime(event.start);
                    var endTime = calculateEndTime(event);

                    build_http_query =[

                    ];
                    var href = encodeURI([
                        'https://www.google.com/calendar/render',
                        '?action=TEMPLATE',
                        '&text=' + (event.title || ''),
                        '&dates=' + (startTime || ''),
                        '/' + (endTime || ''),
                        '&details=' + (event.description || ''),
                        '&location=' + (event.address || ''),
                        '&sprop=&sprop=name:'
                    ].join(''));
                    return '<a class="icon-google" target="_blank" href="' +
                        href + '">"<?php echo e(__('Add To Google Calendar')); ?>"</a>';
                },

                yahoo: function(event) {
                    var eventDuration = event.end ?
                        ((event.end.getTime() - event.start.getTime())/ MS_IN_MINUTES) :
                        event.duration;

                    // Yahoo dates are crazy, we need to convert the duration from minutes to hh:mm
                    var yahooHourDuration = eventDuration < 600 ?
                        '0' + Math.floor((eventDuration / 60)) :
                        Math.floor((eventDuration / 60)) + '';

                    var yahooMinuteDuration = eventDuration % 60 < 10 ?
                        '0' + eventDuration % 60 :
                        eventDuration % 60 + '';

                    var yahooEventDuration = yahooHourDuration + yahooMinuteDuration;

                    // Remove timezone from event time
                    var st = formatTime(new Date(event.start - (event.start.getTimezoneOffset() *
                        MS_IN_MINUTES))) || '';

                    var href = encodeURI([
                        'http://calendar.yahoo.com/?v=60&view=d&type=20',
                        '&title=' + (event.title || ''),
                        '&st=' + st,
                        '&dur=' + (yahooEventDuration || ''),
                        '&desc=' + (event.description || ''),
                        '&in_loc=' + (event.address || '')
                    ].join(''));

                    return '';
                },

                ics: function(event, eClass, calendarName) {
                    var startTime = formatTime(event.start);
                    var endTime = calculateEndTime(event);

                    var href = encodeURI(
                        'data:text/calendar;charset=utf8,' + [
                            'BEGIN:VCALENDAR',
                            'VERSION:2.0',
                            'BEGIN:VEVENT',
                            'URL:' + document.URL,
                            'DTSTART:' + (startTime || ''),
                            'DTEND:' + (endTime || ''),
                            'SUMMARY:' + (event.title || ''),
                            'DESCRIPTION:' + (event.description || ''),
                            'LOCATION:' + (event.address || ''),
                            'END:VEVENT',
                            'END:VCALENDAR'].join('\n'));

                    return '';
                },

                ical: function(event) {
                    return this.ics(event);
                },

                outlook: function(event) {
                    return this.ics(event);
                }
            };

            var generateCalendars = function(event) {
                return {
                    google: calendarGenerators.google(event),
                    yahoo: calendarGenerators.yahoo(event),
                    ical: calendarGenerators.ical(event),
                    outlook: calendarGenerators.outlook(event)
                };
            };

            // Create CSS
            var addCSS = function() {
                if (!document.getElementById('ouical-css')) {
                    document.getElementsByTagName('head')[0].appendChild(generateCSS());
                }
            };

            var generateCSS = function() {
                var styles = document.createElement('style');
                styles.id = 'ouical-css';

                styles.innerHTML = "#add-to-calendar-checkbox-label{cursor:pointer}.add-to-calendar-checkbox~a{display:none}.add-to-calendar-checkbox:checked~a{display:block;width:150px;margin-left:20px}input[type=checkbox].add-to-calendar-checkbox{position:absolute;top:-9999px;left:-9999px}.add-to-calendar-checkbox~a:before{width:16px;height:16px;display:inline-block;background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFQAAAAQCAYAAACIoli7AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoTWFjaW50b3NoKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0MzJCRDU2NUE1MDIxMUUyOTY1Q0EwNTkxNEJDOUIwNCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0MzJCRDU2NkE1MDIxMUUyOTY1Q0EwNTkxNEJDOUIwNCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQzMkJENTYzQTUwMjExRTI5NjVDQTA1OTE0QkM5QjA0IiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjQzMkJENTY0QTUwMjExRTI5NjVDQTA1OTE0QkM5QjA0Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+1Gcb3QAACh1JREFUeNrEWAtw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);margin-right:.5em;content:' '}.icon-ical:before{background-position:-68px 0}.icon-outlook:before{}";

                return styles;
            };

            // Make sure we have the necessary event data, such as start time and event duration
            var validParams = function(params) {
                return params.data !== undefined && params.data.start !== undefined &&
                    (params.data.end !== undefined || params.data.duration !== undefined);
            };

            var generateMarkup = function(calendars, clazz, calendarId) {
                var result = document.createElement('div');

                result.innerHTML += '<input name="add-to-calendar-checkbox" class="add-to-calendar-checkbox" id="checkbox-for-' + calendarId + '" type="checkbox">';

                Object.keys(calendars).forEach(function(services) {
                    result.innerHTML += calendars[services];
                });

                result.className = 'add-to-calendar';
                if (clazz !== undefined) {
                    result.className += (' ' + clazz);
                }

                addCSS();

                result.id = calendarId;
                return result;
            };

            var getClass = function(params) {
                if (params.options && params.options.class) {
                    return params.options.class;
                }
            };

            var getOrGenerateCalendarId = function(params) {
                return params.options && params.options.id ?
                    params.options.id :
                    Math.floor(Math.random() * 1000000); // Generate a 6-digit random ID
            };

            exports.createCalendar = function(params) {
                if (!validParams(params)) {
                    return;
                }

                return generateMarkup(generateCalendars(params.data),
                    getClass(params),
                    getOrGenerateCalendarId(params));
            };
        })(this);
    </script>

</scripts>






<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/payment/payment-success.blade.php ENDPATH**/ ?>