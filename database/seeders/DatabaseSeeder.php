<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Review;
use App\Models\Company;
use App\Models\Message;
use App\Models\JobOffer;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = new User;
        $user->firstname = "Linards";
        $user->surname = "Zīlītis";
        $user->username = "linards123";
        $user->password = Hash::make("Linards!123");
        $user->email = "example@aol.com";
        $user->userrole = 1;
        $user->has_company = true;
        $user->save();

        $user = new User;
        $user->firstname = "Admins";
        $user->surname = "Administrators";
        $user->username = "admins123";
        $user->password = Hash::make("Admins!123");
        $user->email = "admin@tt2exam.lv";
        $user->userrole = 2;
        $user->has_company = false;
        $user->save();
        
        $user = new User;
        $user->firstname = "Piemērs";
        $user->surname = "Piemēriņš";
        $user->username = "piemers123";
        $user->password = Hash::make("Piemers!123");
        $user->email = "piemers@inbox.lv";
        $user->userrole = 1;
        $user->has_company = true;
        $user->save();

        $edu = new Education;
        $edu->userid = 1;
        $edu->institution = "Olaines 1. vidusskola";
        $edu->startyear = 2009;
        $edu->endyear = 2018;
        $edu->program = "Pamatizglītība";
        $edu->save();

        $edu = new Education;
        $edu->userid = 1;
        $edu->institution = "RV3Ģ";
        $edu->startyear = 2018;
        $edu->endyear = 2021;
        $edu->program = "Ekonomikas virziens";
        $edu->save();

        $edu = new Education;
        $edu->userid = 1;
        $edu->institution = "Latvijas Universitāte";
        $edu->startyear = 2021;
        $edu->program = "Datorzinātne";
        $edu->save();

        $exp = new Experience;
        $exp->userid = 2;
        $exp->workplace = "SEB banka";
        $exp->startyear = 2017;
        $exp->endyear = 2000;
        $exp->position = "Senior Developer";
        $exp->save();

        $company = new Company;
        $company->userid = 1;
        $company->name = "Slaisti SIA";
        $company->registryid = 1984032731;
        $company->about = "Automātiskās laistīšanas sistēmu uzstādīšanas uzņēmums";
        $company->homepage = "slaisti.lv";
        $company->location = "Rīgas iela 3";
        $company->save();


        $job = new JobOffer;
        $job->companyid = 1;
        $job->position = "Ežu aprūpētājs";
        $job->category = "Dzīvnieki";
        $job->workload = "Pilna laika slodze";
        $job->salary = 900;
        $job->posted_at = date("Y-m-d");
         
$job->description ="Darba apraksts
Pievienojies Ežu cienītāju kolektīvam Rīgā, Centrā, Avotu ielā 26!

Prasības kandidātiem:
- Latviešu valodas zināšanas

Uzņēmums piedāvā:

- Algu, sākot no 4.00
- Paaugstinātu likmi virsstundās un svētku dienās
- Veselības apdrošināšanu
- Darbinieka atlaižu karti pirkumiem
- Tev ērtu darba laiku, iespēju apvienot darbu ar mācībām / ģimeni / hobijiem un iegūt vērtīgu darba pieredzi
- Feinu darba vidu, kur Tev visu iemācīs, Tevi atbalstīs, izklaidēs, piedāvās konkursus un pasniegs dāvanas svētkos
- Izaugsmes iespējas";
        $job->location = "Rīga, Centrs, Avotu iela 106";
        $job->extra_info = "Nav papildus informācija";
        $job->save();
        
        
        $job = new JobOffer;
        $job->companyid = 1;
        $job->position = "Backend Developer";
        $job->category = "Web Development";
        $job->workload = "Full-time";
        $job->salary = 1800;
        $job->posted_at = date("Y-m-d");
        $job->description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
        Vestibulum consectetur ex non commodo dictum. In eget tincidunt eros, vitae mattis sem. Suspendisse sit amet nibh lorem. 
        Duis vel fermentum velit. Integer eu urna porta, porta purus in, tristique risus. Etiam euismod tellus ac nunc condimentum, id sollicitudin justo pulvinar. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Pellentesque iaculis sapien non turpis porttitor ullamcorper. 
        
        Cras facilisis purus nec massa iaculis, ac eleifend justo venenatis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer ultrices feugiat nunc non feugiat. In enim risus, euismod sit amet purus sed, tristique fermentum sem. Nunc euismod massa non feugiat auctor. Nulla facilisi. Mauris facilisis risus ac enim tristique luctus.

        Nulla volutpat purus ante, non consequat velit semper non. Morbi malesuada placerat velit, eget viverra odio auctor a. Sed eget metus urna. Nullam consectetur ullamcorper ipsum, quis mattis eros vestibulum a. Vivamus sollicitudin auctor fringilla. Curabitur mattis urna vel massa pharetra, nec dignissim risus fringilla. Sed imperdiet orci nec tincidunt lobortis. Proin mattis ultrices rhoncus. 
        
        Interdum et malesuada fames ac ante ipsum primis in faucibus.";
        $job->location = "Zeiferta iela 4";
        $job->extra_info = "Must have 4+ year experience";
        $job->save();

        $job = new JobOffer;
        $job->companyid = 1;
        $job->position = "Sistēmu administrators/-e";
        $job->category = "Informācijas tehnoloģijas";
        $job->workload = "Pilna laika";
        $job->salary = 1300;
        $job->posted_at = date("Y-m-d");
        $job->description = "Darba pienākumu apraksts:
        Darbs ar Windows un Linux sistēmām;
        Datorsistēmu apkalpošana un kļūmju novēršana;
        Primārā defektu diagnostika.
        
        Prasības kandidātiem:
        
        Vismaz vidēja izglītība
        Vismaz 1 gadu pieredze attiecīgajā jomā
        Labas latviešu valodas zināšanas
        
        Mēs piedāvājam:
        Draudzīgu kolektīvu ar lielisku darba atmosfēru
        Stabilu atalgojumu līdz 1300 EUR
        Darba laiks no 10:00 - 19:00";
        $job->location = "Rīga";
        $job->extra_info = "pastāvīgs darbinieks";
        $job->save();
            
        $job = new JobOffer;
        $job->companyid = 1;
        $job->position = "IT administrators";
        $job->category = "Informācijas tehnoloģijas";
        $job->workload = "Pilna slodze";
        $job->salary = 2800;
        $job->posted_at = date("Y-m-d");
        $job->description = "Darba apraksts
        
        Atbalsts filiāles IT infrastruktūrai.
        Jaunu IT tehnoloģiju testēšana, priekšlikumu izstrāde to ievietošanai.
        Tīkla uzraudzības sistēmu, e-pastu atbalsts.
        Windows / Unix serveru konfigurēšanas un administrēšanas ieviešana.
        
        Prasības kandidātiem
        
        Vismaz 2 gadu pieredze IT jomā.
        Zināšanas un izpratne par OSI un TCP/IP modeļiem.
        Zināšanas par lokālo tīklu un VPN principiem.
        Pieredze Linux, Windows un AD domēnu administrēšanā (GPO, DFS u.c.).
        Pieredze ar Zabbix uzraudzības sistēmu.
        Pamata programmēšanas prasmes: Bash, Python, PowerShell, Perl, u.c.
        Angļu valodas zināšanas vismaz vidējā līmenī.
        Labas komunikācijas prasmes.
        
        Uzņēmums piedāvā
        
        Elastīgu darba vidi.
        Daudzas karjeras izaugsmes un paaugstināšanas iespējas.
        Apmācības.";
        $job->location = "Rīga, Centrs";
        $job->extra_info = "Nav papildus informācija";
        $job->save();

        $job = new JobOffer;
        $job->companyid = 1;
        $job->position = "Senior Developer";
        $job->category = "Programmēšana";
        $job->workload = "Nepilna laika";
        $job->salary = 19;
        $job->posted_at = date("Y-m-d");
        $job->description = "testa darba sludinājums 123";
        $job->location = "Rīga, Kr. Valdemāra iela 314";
        $job->extra_info = "Nav papildus informācija";
        $job->save();

        $job = new JobOffer;
        $job->companyid = 1;
        $job->position = "Biroja administrators";
        $job->category = "PR";
        $job->workload = "Pilna laika";
        $job->salary = 19;
        $job->posted_at = date("Y-m-d");
        $job->description = "Tavi galvenie pienākumi būs
        
        Lietvedības kārtošana un korespondences sagatavošana
        Klientu apkalpošana pa telefonu
        Aktīva līdzdalība dažādos projektos
        
        Tevi sagaida
        
        Lieliska pieredze un atbildīgs darbs
        Atalgojums no 850 līdz 1000 €
        Labumu grozs ar veselības apdrošināšanu, pasākumiem
        Draudzīgi kolēģi un ērti darba apstākļi";
        $job->location = "Rīga, Kr. Valdemāra iela 64";
        $job->extra_info = "Nav papildus informācija";
        $job->save();

        $job = new JobOffer;
        $job->companyid = 1;
        $job->position = "Junior Java Developer";
        $job->category = "Programmēšana";
        $job->workload = "Nepilna laika";
        $job->salary = 1900;
        $job->posted_at = date("Y-m-d");
        $job->description = "Java Programming";
        $job->location = "Jelgava";
        $job->extra_info = "test";
        $job->save();
    }
}