<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contact;
use Mail;

class ContactUsFormController extends Controller {

    // crée le formulaire
    public function createForm(Request $request) {
      return view('contact');
    }

    // recolte de data
    public function ContactUsForm(Request $request) {

        // condiiton de validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'subject'=>'required',
            'message' => 'required'
         ]);

        //  stocke se que prend request dans la database
        Contact::create($request->all());

        //  envoi un mail a notre adresse mail admin
        \Mail::send('mail', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'subject' => $request->get('subject'),
            'user_query' => $request->get('message'),
        ), function($message) use ($request){
            $message->from($request->email);
            $message->to('professional.mikailozdemir@gmail.com', 'Admin')->subject($request->get('subject'));
        });

        return back()->with('feliciattion', 'votre message a était transmis.');
    }

}
// code commence par crée un controleur appeller CONTACTUSFORMCON
//Controleur etend la classe controlleur et permet de crée un form pour contacter
//le code crée ensuite une vue appelée contact qui sera renvoyer lorsque cette méthode et appeler
// la ligne Contact::create crée une instance de la fonction qui stock les donné dans la dbb
//après le stockage dans la dbb il envoie la meme au mail admin
// ya aussi une etape validation des data.