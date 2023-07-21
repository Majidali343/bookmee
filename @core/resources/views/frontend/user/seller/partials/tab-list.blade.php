<li class="
    @if(request()->is('seller/orders/active-orders')) active
    @elseif(request()->is('seller/orders/job/active-orders')) active
    @else
    @endif">
    <a href="
    @if(request()->is('seller/orders/deliver-orders')) {{ route('seller.active.orders') }}

     @elseif(request()->is('seller/orders/job/active-orders')) {{ route('seller.job.active.orders') }}
     @elseif(request()->is('seller/orders/job/deliver-orders')) {{ route('seller.job.active.orders') }}
     @elseif(request()->is('seller/orders/job/complete-orders')) {{ route('seller.job.active.orders') }}
     @elseif(request()->is('seller/orders/job/cancel-orders')) {{ route('seller.job.active.orders') }}

     @elseif(request()->is('seller/job-orders')) {{ route('seller.job.active.orders') }}
     @elseif(request()->is('seller/orders/active-orders')) {{ route('seller.active.orders') }}
     @elseif(request()->is('seller/orders/cancel-orders')) {{ route('seller.active.orders') }}
     @elseif(request()->is('seller/orders')) {{ route('seller.active.orders') }}
    @else
    @endif">
        {{ __('Active') }}
        <span class="numbers">
            @if (!empty($active_orders)){{ $active_orders->count() }}@endif
        </span>
    </a>
</li>

<li class="
   @if(request()->is('seller/orders/deliver-orders')) active
    @elseif(request()->is('seller/orders/job/deliver-orders')) active
    @else
    @endif">
    <a href="
   @if(request()->is('seller/orders/deliver-orders')) {{ route('seller.deliver.orders') }}

    @elseif(request()->is('seller/orders/job/deliver-orders')) {{ route('seller.job.deliver.orders') }}
    @elseif(request()->is('seller/orders/job/complete-orders')) {{ route('seller.job.deliver.orders') }}
    @elseif(request()->is('seller/orders/job/active-orders')) {{ route('seller.job.deliver.orders') }}
    @elseif(request()->is('seller/orders/job/cancel-orders')) {{ route('seller.job.deliver.orders') }}

      @elseif(request()->is('seller/job-orders')) {{ route('seller.job.deliver.orders') }}
      @elseif(request()->is('seller/orders/complete-orders')) {{ route('seller.deliver.orders') }}
      @elseif(request()->is('seller/orders/active-orders')) {{ route('seller.deliver.orders') }}
      @elseif(request()->is('seller/orders/cancel-orders')) {{ route('seller.deliver.orders') }}
      @elseif(request()->is('seller/orders')) {{ route('seller.deliver.orders') }}

   @else
   @endif
    ">{{ __('Delivered') }}
        <span class="numbers">
            @if (!empty($deliver_orders)){{ $deliver_orders->count() }}@endif
        </span>
    </a>
</li>

<li class="
    @if(request()->is('seller/orders/complete-orders')) active
     @elseif(request()->is('seller/orders/job/complete-orders')) active
     @else
     @endif">
    <a href="
   @if(request()->is('seller/orders/complete-orders')) {{ route('seller.complete.orders') }}

    @elseif(request()->is('seller/orders/job/deliver-orders')) {{ route('seller.job.complete.orders') }}
    @elseif(request()->is('seller/orders/job/complete-orders')) {{ route('seller.job.complete.orders') }}
    @elseif(request()->is('seller/orders/job/active-orders')) {{ route('seller.job.complete.orders') }}
    @elseif(request()->is('seller/orders/job/cancel-orders')) {{ route('seller.job.complete.orders') }}

      @elseif(request()->is('seller/orders/cancel-orders')) {{ route('seller.complete.orders') }}
      @elseif(request()->is('seller/job-orders')) {{ route('seller.job.complete.orders') }}
      @elseif(request()->is('seller/orders/active-orders')) {{ route('seller.complete.orders') }}
      @elseif(request()->is('seller/orders/deliver-orders')) {{ route('seller.complete.orders') }}
      @elseif(request()->is('seller/orders')) {{ route('seller.complete.orders') }}
   @else
   @endif">
        {{ __('Completed') }}
        <span class="numbers">
            @if (!empty($complete_orders)){{ $complete_orders->count() }}@endif
        </span>
    </a>
</li>


<li class="
    @if(request()->is('seller/orders/cancel-orders')) active
    @elseif(request()->is('seller/orders/job/cancel-orders')) active
    @else
    @endif">
    <a href="
     @if(request()->is('seller/orders/cancel-orders')) {{ route('seller.cancel.orders') }}
      @elseif(request()->is('seller/orders/job/cancel-orders')) {{ route('seller.job.cancel.orders') }}
      @elseif(request()->is('seller/orders/job/deliver-orders')) {{ route('seller.job.cancel.orders') }}
      @elseif(request()->is('seller/orders/job/active-orders')) {{ route('seller.job.cancel.orders') }}
      @elseif(request()->is('seller/orders/job/complete-orders')) {{ route('seller.job.cancel.orders') }}

     @elseif(request()->is('seller/job-orders')) {{ route('seller.job.cancel.orders') }}
     @elseif(request()->is('seller/orders/active-orders')) {{ route('seller.cancel.orders') }}
     @elseif(request()->is('seller/orders/complete-orders')) {{ route('seller.cancel.orders') }}
     @elseif(request()->is('seller/orders/deliver-orders')) {{ route('seller.cancel.orders') }}
     @elseif(request()->is('seller/orders')) {{ route('seller.cancel.orders') }}
     @else
      @endif">
        {{ __('Cancelled') }}
        <span class="numbers">
            @if (!empty($cancel_orders)){{ $cancel_orders->count() }}@endif
        </span>
    </a>
</li>

<li class="
 @if(request()->is('seller/orders')) active
 @elseif(request()->is('seller/job-orders')) active
 @elseif(request()->is('seller/orders/job/cancel-orders'))
 @else
 @endif">
    <a href="
    @if(request()->is('seller/orders')) {{ route('seller.orders') }}
    @elseif(request()->is('seller/job-orders')) {{ route('seller.job.orders') }}
    @elseif(request()->is('seller/orders/job/cancel-orders')) {{ route('seller.job.orders') }}
    @elseif(request()->is('seller/orders/job/complete-orders')) {{ route('seller.job.orders') }}
    @elseif(request()->is('seller/orders/job/deliver-orders')) {{ route('seller.job.orders') }}
    @elseif(request()->is('seller/orders/job/active-orders')) {{ route('seller.job.orders') }}
    @elseif(request()->is('seller/orders/cancel-orders')) {{ route('seller.orders') }}
    @elseif(request()->is('seller/orders/complete-orders')) {{ route('seller.orders') }}
    @elseif(request()->is('seller/orders/deliver-orders')) {{ route('seller.orders') }}
    @elseif(request()->is('seller/orders/active-orders')) {{ route('seller.orders') }}
    @else
    @endif">{{ __('All') }}
        <span class="numbers">
        @if (!empty($orders)){{ $orders->count() }}@endif
    </span>
    </a>
</li>
