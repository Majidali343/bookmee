<?php

namespace App\Http\Controllers;

use App\Helpers\FlashMsg;
use App\SupportTicket;
use App\SupportTicketMessage;
use Illuminate\Http\Request;

class AdminTicketViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ticket-list|ticket-view|ticket-delete',['only' => ['tickets']]);
        $this->middleware('permission:ticket-view',['only' => ['ticketDetails']]);
        $this->middleware('permission:ticket-delete',['only' => ['ticketDelete']]);
    }

    public function tickets(){
        $all_tickets = SupportTicket::all();
        return view('backend.pages.ticket.tickets',compact('all_tickets'));
    }

    public function ticketDetails($id){
        $ticket_details = SupportTicket::findOrFail($id);
        $all_messages = SupportTicketMessage::where(['support_ticket_id'=>$id])->get();
        $q = $request->q ?? '';
        return view('backend.pages.ticket.ticket-details', compact('ticket_details','all_messages','q'));
    }

        public function ticketDelete($id=null)
        {
            SupportTicketMessage::where('support_ticket_id',$id)->delete();
            SupportTicket::find($id)->delete();
            return redirect()->back()->with(FlashMsg::item_new('Ticket Delete Success.'));
        }
}
