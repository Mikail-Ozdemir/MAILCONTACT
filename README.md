1/ Etablir la connexion entre la BDD et l'application grace au fichier .env .

2/ Crée un model qui et un fichier migration qui nous permettra détablir un schéma de la table
~php artisan make:model Contact -m

dans le fichier database/migrations/.....contacts...table.php on ajoutera dans la méthode public function up

 Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('subject');
            $table->text('message');
            $table->timestamps();
        });
modifiable si d'autre information et néccessaire .

app/models/contact.php

class Contact extends Model
{
    use HasFactory;
    public $fillable = ['name', 'email', 'phone', 'subject', 'message'];
}

après avoir fais ces modifications vous pouvez migret la dbb
~php artisan migrate

3/ Crée un Formulaire de contact pour ca on va crée un controller et lui crée des méthode qui vont nous permettre de gerrer les informations 
du formulaire

~php artisan make:controller ContactUsFormController

on va utiliser $request dans les param des méthodes crée pour nous servires a utiliser la validation intégrée de laravel

4/ Dans web.php on va  definir la route la en occurence deux, la premier en get qui va afficher le form
la seconde en post elle va gerrer les taches comme valider les données du forms le stockage des donné et les affichage du message
pour l'utilisateur si son mail et bien parvenus...

5/ Créer la views blade contact dans resources/views/ , créer le form sans oublier les balise @csrf qui permette de protèger le form 
des attaques comme CSRF ou XSRF, rajouté les condition pour les erreurs grace à $errors->has(), indiqué le bon nom entre paranthése car laravel 
a des messages d'erreur pour l'utilisateur deja enregistrer selon l'erreur(modifiable ajoutable si nécessaire)

6/ Créer le template du mail a envoyer  resources/views/mail.blade.php en precisant les champs, surtout ne pas oublier le sujet car les boite email on 
tendance à concidére les message dans sujet comme des spam voir pire.

7/ Configurer le fichier .env pour les info du mailer  

8/ Créer la fonction de messagerie dans la base de l'application
~ php artisan make:mail contact

retourner dans le controller ContactUsFormController et mettre la methode mail::send en place

enjoys
