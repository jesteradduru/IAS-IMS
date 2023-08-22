<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\AwolStatusHistory;
use App\Models\AwolStatusProcess;
use App\Models\TamangBihisViolation;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\InspectingOffice::factory(5)->create();
        \App\Models\Unit::factory(5)->create();

        $infractions = array('Unauthorized Headgear',
                    'No Headgear',
                    'Unauthorized Fabric for Upper Garment',
                    'Faded Uniform',
                    'Faded Upper Garment',
                    'Fabric not the same in color w/ lousy hat and upper garment (Trouser/Lower Garment)',
                    'Unauthorized Rank Insignia',
                    'Faded Name Cloth',
                    'Faded Patches',
                    'Faded Rank  Insignia',
                    'Unauthorized Belt',
                    'No Belt',
                    'Unshined Buckle',
                    'Unauthorized Buckle',
                    'Unauthorized Black Socks',
                    'No Socks',
                    'Unauthorized Shoes',
                    'Unshined Shoes',
                    'Unauthorized socks',
                    'No hairnet',
                    'Unauthorized haircut)',
                    'Unauthorized Shirt Color for PNP Athletic Uniform (Upper Garment)',
                    'Unauthorized Print Color for PNP Athletic Uniform (Upper Garment)',
                    'Untucked Upper Garment for PNP Athletic Uniform',
                    'Unauthorized Fabric Color  for PNP Athletic Uniform (Lower Garment)',
                    'Unauthorized Embroidery Color for PNP Athletic Uniform (Lower Garment)',
                    'Unauthorized Lower Garment for PNP Athletic Uniform ',
                    'Untied Hair for Female PNP Personnel',
                    'Unauthorized Headgear',
                    'Dilapidated/Faded Headgear',
                    'Unauthorized Upper Garment (e.g. with zipper/different cut) for GOA C Uniform',
                    'Faded Upper Garment for GOA C Uniform)',
                    'Unauthorized Shoulder Loop',
                    'Unauthorized Embroided Badge',
                    'Unauthorized Pistol Belt',
                    'Tarnished Buckle',
                    'Unauthorized Black Socks',
                    'Colored Socks',
                    'Unauthorized PNP Dress Shoes/wet look (if in pants)',
                    'Unauthorized PNP Ladies Shoes, more than Four holes and 1.5 inch high heels (if Female wearing skirt)',
                    'No citation Decoration Ribbon displayed (except for new Uniformed Personnel)',
                    'Unauthorized Decorations/ Ribbons displayed (except for new Uniformed Personnel)',
                    'Long hair noticeably unpinned or not fastened on the head in unattractive style for Female PNP Personnel',
                    'Use of eye-catching rubber bands, combs, and pins for Female PNP Personnel',
                    'Long Nails',
                    'Untrimmed Nails',
                    'Colored Nails',
                    'Hair color is faddish or outrageously multi-colored, it appear unnatural and not complimentary ',
                    'Not neat, unclean and not well-groomed',
                    'Unshaved Mustache',
                    'Ostentatious Jewelry',
                    'Unauthorized eyeglasses or sunglasses that are trendy have lenses or frames with too large initials, designs, or other adornments ',
                    'Used of cosmetics that do not blend with the natural skin tone to enhance natural features',
                    'Used of unconservative lipstick color that complements the uniform',
                    'Used of false eyelashes that are inappropriate and worn in uniform',
                    'Others'
        );

        foreach($infractions as $infraction) {
            TamangBihisViolation::create([
                'name' => trim($infraction)
            ]);
        }

        $user = User::create([
            'name' => 'Test Account',
            'email' => 'test@mail.dev',
            'password' => Hash::make('12345678'),
        ]);

        $status = array(
            ["title" => "ADMIN", "description" => "Reported AWOL"],
            ["title" => "NOTICE TO RTW", "description" => "After five days of AWOL, send notice to Return To Work (RTW): Issue order for stoppage of salary"],
            ["title" => "REFERRAL TO PCI", "description" => "Send notice to respondent to submit explanation/counter-affidavit"],
            ["title" => "DLOD/DLOS", "description" => "Referral to Summary Hearing Officer (SHO)"],
            ["title" => "SHP", "description" => "Proceed to summary hearing proceedings"],
            ["title" => "DLOD/DLOS", "description" => "Drafting of decision for administrative case; and Issue DFR order"],
            ["title" => "DA", "description" => "Approval and Signature of the Disciplinary Authority"],
            ["title" => "DLOD/DLOS", "description" => 'Proof of Service; Implementation of Decision; Section 95, Rule 19, RRACCS provides: "The order of separation is immediately executory pending appeal, unless the CSC, on meritorious grounds, directs otherwise."'],
        );

        foreach($status as $key=>$stat){
            if($key + 1 == count($status)){
                AwolStatusProcess::create([
                    "title" => $stat['title'], "description" => $stat['description'], 'final' => true
                ]);
            }else{
                AwolStatusProcess::create([
                    "title" => $stat['title'], "description" => $stat['description']
                ]);
            }
        }



    }
}
