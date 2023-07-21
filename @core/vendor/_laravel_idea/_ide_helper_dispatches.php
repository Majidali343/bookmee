<?php //14d80e3a6c9d0cb1cdf40c95408579b0
/** @noinspection all */

namespace App\Events {

    use Modules\LiveChat\Entities\LiveChatMessage;
    
    /**
     * @method static void broadcast(LiveChatMessage $message)
     * @method static void dispatch(LiveChatMessage $message)
     */
    class MessageSent {}
    
    /**
     * @method static void broadcast($message)
     * @method static void dispatch($message)
     */
    class SupportMessage {}
}

namespace Illuminate\Foundation\Console {
    
    /**
     * @method static void dispatch(array $data)
     * @method static void dispatchNow(array $data)
     */
    class QueuedCommand {}
}

namespace Illuminate\Queue {

    use Laravel\SerializableClosure\SerializableClosure;
    
    /**
     * @method static void dispatch(SerializableClosure $closure)
     * @method static void dispatchNow(SerializableClosure $closure)
     */
    class CallQueuedClosure {}
}

namespace Tzsk\Payu\Events {

    use Tzsk\Payu\Models\PayuTransaction;
    
    /**
     * @method static void dispatch(PayuTransaction $transaction)
     * @method static void dispatchNow(PayuTransaction $transaction)
     */
    class TransactionFailed {}
    
    /**
     * @method static void dispatch(PayuTransaction $transaction)
     * @method static void dispatchNow(PayuTransaction $transaction)
     */
    class TransactionInitiated {}
    
    /**
     * @method static void dispatch(PayuTransaction $transaction)
     * @method static void dispatchNow(PayuTransaction $transaction)
     */
    class TransactionInvalidated {}
    
    /**
     * @method static void dispatch(PayuTransaction $transaction)
     * @method static void dispatchNow(PayuTransaction $transaction)
     */
    class TransactionSuccessful {}
}

namespace Tzsk\Payu\Jobs {

    use Tzsk\Payu\Models\PayuTransaction;
    
    /**
     * @method static void dispatch(PayuTransaction $transaction)
     * @method static void dispatchNow(PayuTransaction $transaction)
     */
    class VerifyTransaction {}
}