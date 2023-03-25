<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CreateAllTablesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will create all the tables';

     /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Cleaning...');

        // Before start creating tables drop all tables if exists
        $this->dropIfExists();

        $this->info('Tables start creating...');
        //create admins table
        Schema::create('admins', function ($table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('last_name');
            $table->string('first_name');
            $table->enum('gender', ['M', 'F']);
            $table->string('phone');
            $table->string('image_profile')->nullable();
            $table->timestamps();
        });
        //create hotels table
        Schema::create('hotels', function ($table) {
            $table->id();
            $table->string('designation')->unique();
            $table->string('description');
            $table->string('region');
            $table->string('ville');
            $table->integer('note');
            $table->string('adresse');
            $table->string('mockup')->nullable();
            $table->timestamps();
        });
         //create chambres table
         Schema::create('chambres', function ($table) {
            $table->id();
            $table->uuid('numero')->unique();
            $table->boolean('disponibilite');
            $table->double('prix');
            $table->string('type');
            $table->string('mockup')->nullable();
            $table->unsignedBigInteger('hotel_id');
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->timestamps();
        });
        //create services table
        Schema::create('services', function ($table) {
            $table->id();
            $table->string('libelle')->unique();
            $table->string('description');
            $table->double('prix');
            $table->string('conditions');
            $table->unsignedBigInteger('hotel_id');
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->timestamps();
        });
        //create equipements table
        Schema::create('equipements', function ($table) {
            $table->id();
            $table->string('designation')->unique();
            $table->string('mockup')->nullable();
            $table->unsignedBigInteger('chambre_id');
            $table->foreign('chambre_id')->references('id')->on('chambres')->onDelete('cascade');
            $table->timestamps();
        });
        //create clients table
        Schema::create('clients', function ($table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('prenoms');
            $table->string('telephone');
            $table->string('adresse');
            $table->string('email');
            $table->enum('sexe', ['M', 'F']);
            $table->timestamps();
        });
         //create gestonnaires table
         Schema::create('gestionnaires', function ($table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('username');
            $table->string('telephone');
            $table->string('adresse');
            $table->string('passsword');
            $table->enum('sexe', ['M', 'F']);
            $table->unsignedBigInteger('hotel_id');
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->timestamps();
        });
        //create reservations chambres table
        Schema::create('reservations_chambres', function ($table) {
            $table->id();
            $table->datetime('date_arrivee');
            $table->datetime('date_depart');
            $table->double('net_payer');
            $table->unsignedBigInteger('chambre_id');
            $table->foreign('chambre_id')->references('id')->on('chambres')->onDelete('cascade');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->timestamps();
        });
        //create demandes de services table
        Schema::create('demandes_services', function ($table) {
            $table->id();
            $table->double('net_payer');
            $table->datetime('debut');
            $table->datetime('fin');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->timestamps();
        });
        //create notifications  table
        Schema::create('notifications', function ($table) {
            $table->id();
            $table->string('sujet');
            $table->string('message');
            $table->enum('status', ['unread', 'read']);
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->unsignedBigInteger('gestionnaire_id')->nullable();
            $table->foreign('gestionnaire_id')->references('id')->on('gestionnaires')->onDelete('cascade');
            $table->timestamps();
        });

        $this->info('Success .....');
    }

    private function dropIfExists(){
        Schema::dropIfExists('admins');
        Schema::dropIfExists('hotels');
        Schema::dropIfExists('chambres');
        Schema::dropIfExists('services');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('gestionnaires');
        Schema::dropIfExists('equipements');
        Schema::dropIfExists('reservations_chambres');
        Schema::dropIfExists('demandes_services');
    }
}
