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
        $user->password = Hash::make("Example!123");
        $user->email = "example@aol.com";
        $user->userrole = 1;
        $user->has_company = true;
        $user->save();

        $user = new User;
        $user->firstname = "Admins";
        $user->surname = "Administrators";
        $user->username = "admins12";
        $user->password = Hash::make("Example!123");
        $user->email = "email@email.email";
        $user->userrole = 2;
        $user->has_company = false;
        $user->save();

        $edu = new Education;
        $edu->userid = 1;
        $edu->institution = "RV3G";
        $edu->startyear = 2018;
        $edu->endyear = 2021;
        $edu->program = "econcomics";
        $edu->save();

        $exp = new Experience;
        $exp->userid = 1;
        $exp->workplace = "SEB banka";
        $exp->startyear = 2017;
        $exp->endyear = 2000;
        $exp->position = "senior developer";
        $exp->save();

        $msg = new Message;
        $msg->senderid = 2;
        $msg->receiverid = 1;
        $msg->message = "please behave and dont break the website's rules";
        $msg->save();

        $company = new Company;
        $company->userid = 1;
        $company->name = "Slaisti SIA";
        $company->registryid = 23553945;
        $company->about = "Esam laistīšanas uzstādīšanas uzņēmums, juridiska persona lorem ipsum";
        $company->homepage = "google.com";
        $company->location = "Rīgas iela 3";
        $company->save();

        $review = new Review;
        $review->companyid = 1;
        $review->userid = 1;
        $review->rating = 4;
        $review->comment = "veikli uzstāda laistīšanu";
        $review->save();

        $job = new JobOffer;
        $job->companyid = 1;
        $job->position = "Laistītājs";
        $job->category = "Apsaimniekošana";
        $job->workload = "Pilna laika slodze";
        $job->salary = 900;
        $job->posted_at = date("Y-m-d");
         
$job->description ="<p>Darba apraksts</p>
<span>Pievienojies Drogas kolektīvam Rīgā, Centrā, Avotu ielā 26</span>
<p>Prasības kandidātiem</p>
<span>Latviešu valodas zināšanas</span>
<p>Uzņēmums piedāvā</p>
<ul>
    <li>Algu, sākot no 4.00 (stundas likme - jo vairāk strādā, jo vairāk nopelni), (nomaksāti visi nodokļi)</li>
    <li>Paaugstinātu likmi virsstundās un svētku dienās</li>
    <li>Ikmēneša prēmijas</li>
    <li>Dāvanā kosmētikas produktu par katru nostrādāto nedēļu pārbaudes laikā</li>
    <li>Veselības apdrošināšanu</li>
    <li>Darbinieka atlaižu karti pirkumiem veikalos Drogas</li>
    <li>Tev ērtu darba laiku, iespēju apvienot darbu ar mācībām / ģimeni / hobijiem un iegūt vērtīgu darba pieredzi</li>
    <li>Feinu darba vidu, kur Tev visu iemācīs, Tevi atbalstīs, izklaidēs, piedāvās konkursus un pasniegs dāvanas svētkos</li>
    <li>Izaugsmes iespējas - ātri kļūt par vecāko pārdevēju / veikala vadītāju / biroja darbinieku</li>
</ul>
<p>Jebkādi Drogām sniegtie personu dati tiks apstrādāti atbilstoši piemērojamiem tiesību aktiem par datu aizsardzību un tiks izmantoti tikai personāla atlasei. Mēs glabājam personu datus līdz 1 gadam, pēc tam tos anonimizējam vai iznīcinām. Vairāk informācijas par tiesībām uz privātumu un kā sazināties ar mums, atrodams mājas lapā Privātuma politikas sadaļā.</p>";
        $job->location = "Rīga, Rīgas iela 3";
        $job->extra_info = "nav papildus informācija";
        $job->save();
        
        
        $job = new JobOffer;
        $job->companyid = 1;
        $job->position = "Gamer";
        $job->category = "Esports";
        $job->workload = "Pilna laika slodze";
        $job->salary = 900;
        $job->posted_at = date("Y-m-d");
        $job->description = "Plays games";
        $job->location = "Rīga, Rīgas iela 3";
        $job->extra_info = "nav papildus informācija";
        $job->save();

        
        $job = new JobOffer;
        $job->companyid = 1;
        $job->position = "Laravel Developer";
        $job->category = "Front-end";
        $job->workload = "Pilna laika slodze";
        $job->salary = 900;
        $job->posted_at = date("Y-m-d");
        $job->description = "Veido mājaslapas";
        $job->location = "Rīga, Rīgas iela 3";
        $job->extra_info = "nav papildus informācija";
        $job->save();

        
        $job = new JobOffer;
        $job->companyid = 1;
        $job->position = "Lorem Ipsum 1";
        $job->category = "Ipsum";
        $job->workload = "Pilna laika slodze";
        $job->salary = 900;
        $job->posted_at = date("Y-m-d");
        $job->description = "Nam id orci eget elit consequat aliquam. Aliquam quis mauris vehicula, porta sapien ut, rutrum ante. Proin vel dui egestas, condimentum turpis vitae, viverra sapien. Nullam convallis sapien id lorem rhoncus viverra. Sed condimentum gravida odio id viverra. Cras vel tempor odio. Morbi malesuada nisl diam, in faucibus ligula molestie egestas. Quisque velit nibh, scelerisque ut mollis nec, ullamcorper eget mauris. Sed pretium ultricies tortor a faucibus. Aliquam molestie ut urna ac congue. Mauris vehicula porttitor ante id semper.";
        $job->location = "Rīga, Rīgas iela 3";
        $job->extra_info = "nav papildus informācija";
        $job->save();

        $job = new JobOffer;
        $job->companyid = 1;
        $job->position = "Lorem Ipsum 2";
        $job->category = "Front-end";
        $job->workload = "Pilna laika slodze";
        $job->salary = 900;
        $job->posted_at = date("Y-m-d");
        $job->description = "Etiam auctor pretium lobortis. Nam orci lectus, convallis sit amet purus at, tristique eleifend metus. In at massa a felis tincidunt malesuada. Suspendisse ornare finibus arcu sed finibus. Etiam suscipit tellus sit amet purus consequat, ac iaculis metus condimentum. Sed ligula urna, dignissim eget accumsan vel, consectetur ac diam. Mauris hendrerit hendrerit dui vel feugiat. Suspendisse cursus nibh ut malesuada pretium. Integer ultricies finibus euismod. Vivamus fermentum imperdiet risus, non laoreet dolor pharetra id. Donec convallis efficitur lacus quis placerat. Aliquam laoreet sit amet ante ut lacinia. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vestibulum consequat cursus felis, eget faucibus magna feugiat ut. Donec cursus a nunc sit amet condimentum. Nullam sem ligula, pretium non mollis viverra, imperdiet a nibh.";
        $job->location = "Rīga, Rīgas iela 3";
        $job->extra_info = "nav papildus informācija";
        $job->save();
    }
}
