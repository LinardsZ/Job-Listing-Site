<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Education;
use App\Models\Experience;
use App\Models\JobOffer;
use App\Models\Message;
use App\Models\Review;
use App\Models\User;
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
        $user->password = "testpassword";
        $user->email = "example@aol.com";
        $user->userrole = 1;
        $user->save();

        $user = new User;
        $user->firstname = "Admins";
        $user->surname = "Administrators";
        $user->username = "admins12";
        $user->password = "parole";
        $user->email = "email@email.email";
        $user->userrole = 2;
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
        $company->username = "slaistilv";
        $company->password = "$%TGDRT HG%^ Y%^& BDX";
        $company->email = "mail16@example.com";
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
        $job->description = "Jāprot strādāt ar dažādu ekipējumu, jābūt darba pieredzei automātisku laistīšanas sistēmu instalēšanā.";
        $job->save();
        
        
        $job = new JobOffer;
        $job->companyid = 1;
        $job->position = "Gamer";
        $job->category = "Esports";
        $job->workload = "Pilna laika slodze";
        $job->salary = 900;
        $job->posted_at = date("Y-m-d");
        $job->description = "Plays games";
        $job->save();

        
        $job = new JobOffer;
        $job->companyid = 1;
        $job->position = "Laravel Developer";
        $job->category = "Front-end";
        $job->workload = "Pilna laika slodze";
        $job->salary = 900;
        $job->posted_at = date("Y-m-d");
        $job->description = "Veido mājaslapas";
        $job->save();

        
        $job = new JobOffer;
        $job->companyid = 1;
        $job->position = "Lorem Ipsum 1";
        $job->category = "Ipsum";
        $job->workload = "Pilna laika slodze";
        $job->salary = 900;
        $job->posted_at = date("Y-m-d");
        $job->description = "Nam id orci eget elit consequat aliquam. Aliquam quis mauris vehicula, porta sapien ut, rutrum ante. Proin vel dui egestas, condimentum turpis vitae, viverra sapien. Nullam convallis sapien id lorem rhoncus viverra. Sed condimentum gravida odio id viverra. Cras vel tempor odio. Morbi malesuada nisl diam, in faucibus ligula molestie egestas. Quisque velit nibh, scelerisque ut mollis nec, ullamcorper eget mauris. Sed pretium ultricies tortor a faucibus. Aliquam molestie ut urna ac congue. Mauris vehicula porttitor ante id semper.";
        $job->save();

        $job = new JobOffer;
        $job->companyid = 1;
        $job->position = "Lorem Ipsum 2";
        $job->category = "Front-end";
        $job->workload = "Pilna laika slodze";
        $job->salary = 900;
        $job->posted_at = date("Y-m-d");
        $job->description = "Etiam auctor pretium lobortis. Nam orci lectus, convallis sit amet purus at, tristique eleifend metus. In at massa a felis tincidunt malesuada. Suspendisse ornare finibus arcu sed finibus. Etiam suscipit tellus sit amet purus consequat, ac iaculis metus condimentum. Sed ligula urna, dignissim eget accumsan vel, consectetur ac diam. Mauris hendrerit hendrerit dui vel feugiat. Suspendisse cursus nibh ut malesuada pretium. Integer ultricies finibus euismod. Vivamus fermentum imperdiet risus, non laoreet dolor pharetra id. Donec convallis efficitur lacus quis placerat. Aliquam laoreet sit amet ante ut lacinia. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vestibulum consequat cursus felis, eget faucibus magna feugiat ut. Donec cursus a nunc sit amet condimentum. Nullam sem ligula, pretium non mollis viverra, imperdiet a nibh.";
        $job->save();
    }
}
