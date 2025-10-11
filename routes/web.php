<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

// Public pages
Route::view('/welcome', 'welcomepage.welcome');
Route::view('/about', 'aboutpage.index');
Route::view('/news', 'aboutpage.news');
Route::view('/events', 'aboutpage.events');
Route::view('/contact', 'contactus.index');

// For news details page
Route::get('/news/{id}', function ($id) {
    $news = [
        [
            'id' => 1,
            'title' => 'UdD first ever escalator',
            'date' => 'June 3, 2024',
            'image' => asset('images/news1.png'),
            'description' => 'UdD Founder and Chairman of the Board, Dr. Voltaire P. Arzadon, spearheaded theinauguration of the first ever escalator of the campus.UdD stands out as the only school in Pangasinan and one of the few in the country equipped with both escalators and elevators.'
        ],
        [
            'id' => 2,
            'title' => 'Capilano University honored Universidad de Dagupan as its Most Outstanding Global Partner',
            'date' => 'February 25, 2025',
            'image' => asset('images/news2.png'),
            'description' => 'Capilano University honored Universidad de Dagupan as its Most Outstanding Global Partner. The award was presented by CapU President Paul Dangerfield and received by UdD President Dr. Feliza Arzadon-Sua during the MOA Signing Ceremony on February 25. This recognition highlights the strong academic collaboration between the two institutions.'
        ],
        [
            'id' => 3,
            'title' => 'UdD celebrates 75th Foundation Anniversary with week-long festivities',
            'date' => 'January 17, 2025',
            'image' => asset('images/news3.png'),
            'description' => 'Universidad de Dagupan is officially ISO 21001:2018 certified, a globally recognized standard for Educational Organizations Management Systems. This remarkable milestone makes UdD the first institution in Region 1 to achieve this prestigious certification, underscoring its commitment to delivering quality education and fostering excellence.
                            The certification was formally presented on January 17, 2025, by representatives from TÜV SÜD PSB Philippines: Ms. Pamela Gunay, Senior Sales Manager, Business Assurance, and Ms. Jogie Codinera, Sales Executive. Their presence marked the culmination of the university’s dedication to implementing an efficient and effective management system that meets international standards.
                            The certification was received by Dr. Voltaire P. Arzadon, Chairman of the Board of Trustees; Dr. Loreta C. Arzadon, Treasurer of the Board of Trustees; Dr. Alfred Quinto, member of the Board of Trustees; Dr. Feliza Arzadon-Sua, University President; Sir Jann Alfred Arzadon Quinto, Chief Operating Officer; and Dr. Justin Callesto, Vice President for Administration and Finance.
                            Joining the celebration were distinguished guests from the Commission on Higher Education (CHED) Region 1: Engr. Angelica Q. Dolores, Supervising Education Program Specialist, and Dr. Danilo T. Bose, Chief Education Program Specialist. Also present to witness the historic event was Atty. Aurora E. Valle, Dagupan City Legal Officer, whose support further highlighted the significance of this achievement for the university and the local community.
                            This certification highlights Universidad de Dagupan’s unwavering commitment to addressing the needs of learners and stakeholders while promoting continuous improvement and innovation. It solidifies the university’s reputation as a premier educational institution, not only in the region but also on a national and international scale.
                            The entire Universidad de Dagupan community celebrates this momentous accomplishment, which reflects the collective efforts of its faculty, staff, and leadership. Together, the university strives to set new benchmarks in academic and administrative excellence, ensuring a brighter future for its students and stakeholders.'
        ],
        [
            'id' => 4,
            'title' => 'Universidad de Dagupan Achieves 100% Passing Rate in Nurses Licensure Exam',
            'date' => 'November 28, 2024',
            'image' => asset('images/news4.png'),
            'description' => 'Universidad de Dagupan has proudly achieved a perfect 100% passing rate in the recent November Nursing Licensure Examination, marking a significant milestone in the university’s history. This remarkable achievement underscores the institution’s unwavering commitment to academic excellence and the quality of its nursing program. The university’s students, supported by dedicated faculty, demonstrated exceptional skills, knowledge, and determination throughout their preparation. This success is a testament to the hard work and perseverance of both students and educators. Universidad de Dagupan continues to lead the way in producing highly competent and compassionate healthcare professionals, setting a standard of excellence in nursing education.'
        ],
        [
            'id' => 5,
            'title' => 'Universidad de Dagupan is now an official signatory of The SDG Accord',
            'date' => 'November 28, 2024',
            'image' => asset('images/news5.png'),
            'description' => 'Universidad de Dagupan, led by University President Dr. Feliza Arzadon-Sua, is now an official signatory of The SDG Accord—joining the global movement for sustainable development in higher education. Together, we are committed to making a transformative impact and achieving the UN Sustainable Development Goals by 2030!'
        ],
        [
            'id' => 6,
            'title' => 'UdD signs MOA with Smartbridge for Internship and Enhancement Program',
            'date' => 'May 10, 2025',
            'image' => asset('images/news6.png'),
            'description' => 'Universidad de Dagupan (UdD) has officially signed recently a Memorandum of Agreement (MOA) with Smartbridge, a leading EdTech company based in India, to provide an international internship and enhancement program for students in Information Technology, Computer Science, and Engineering.
                            Representing UdD was University President Dr. Feliza Arzadon-Sua, while Smartbridge was represented by its Founder and CEO, Amarender Katkam.
                            This partnership marks a significant milestone, making UdD the only higher education institution in Northern Luzon to establish a collaboration with Smartbridge. The program aims to equip students with global industry exposure, advanced technical skills, and real-world project experience.
                            The signing was witnessed by key university officials including Dr. Voltaire P. Arzadon (Chairman), Sir Jann Alfred A. Quinto (Chief Operating Officer and Dean of the School of Information and Technology Education), Dr. Caridad Abuan (Vice President for Academic Affairs), Ms. Jass Verzola (Director for International and Local Linkages), Engr. Romulo Pinlac (Internship Coordinator), Engr. Rod Cabana (Engineering Program Head), and Sir Arnaldy Fortin (IT Program Head).
                            This partnership is part of UdD’s internationalization efforts to further enhance student competencies and global readiness.'
        ],
        [
            'id' => 7,
            'title' => 'Universidad de Dagupan proves once again it is the HOT spot — Home Of Topnotchers',
            'date' => 'April 30, 2025',
            'image' => asset('images/news7.png'),
            'description' => 'Engr. Samuel F. Flores securing TOP 3 in the April 2025 Registered Electrical Engineers
                            Licensure Examination!
                            Proudly achieving a 100% passing rate for first takers, UdD continues its streak of excellence in engineering and beyond.
                            Year after year, we do not just pass — we TOP!'
        ],
        [
            'id' => 8,
            'title' => 'Universidad de Dagupan: The First HEI in the Philippines to Offer Training in Applied Behavior Analysis.',
            'date' => 'April 7, 2025',
            'image' => asset('images/news8.png'),
            'description' => 'Universidad de Dagupan has signed a Memorandum of Agreement with the Professional Behavior Analysts Association of the Philippines (PBAAP) to launch the country’s first Supervisor Training Certificate on Applied Behavior Analysis.
                            The signing ceremony was graced by UdD President Dr. Feliza Arzadon-Sua, Vice President for Administration and Finance Dr. Justin Frances Callesto, Dr. Joshua Jessel of Brock University, and Dr. Neil Martin of the Behavior Analyst Certification Board.
                            This groundbreaking initiative, led by Executive Vice President Dr. Awit Arzadon-Dalusong, strengthens UdD’s commitment to academic excellence, professional growth, and lifelong learning.'
        ],
        [
            'id' => 9,
            'title' => 'UdD rolls out Eco-Friendly E-Jeeps in Test Run',
            'date' => 'January 29, 2025',
            'image' => asset('images/news9.png'),
            'description' => 'Universidad de Dagupan proudly launched its new electronic jeeps, conducting a successful test run today around Dagupan City. This eco-friendly initiative aims to provide a sustainable and convenient transportation option for students while promoting green mobility within the community.
                            The test run was closely inspected by the Land Transportation Franchising and Regulatory Board (LTFRB), led by Region 1 Director Tal Romero Sibayan, ensuring compliance with safety and regulatory standards. Also in attendance were CHEDRO1 Director Dr. Christine N. Ferrer;TESDA Pangasinan Director Dr. James F. Ferrer and eFuture Motors PH Sales & Marketing Representative Nestor Loverez; UDD Chief Operating Officer Sir Jann Alfred Quinto; UDD Board of Trustees Member Dr. Gef Quinto and his wife, Ma’am Ross Quinto; UdD VP for Administration and Finance Dr. Justin Q. Callesto;  along with UDD student leaders and employees.'
        ],
        [
            'id' => 10,
            'title' => 'Milpitas Vice Mayor visits UdD, hints at future partnership',
            'date' => 'April 3, 2025',
            'image' => asset('images/news10.png'),
            'description' => 'Milpitas City (California, USA) Vice Mayor Garry Barbadillo visited Universidad de Dagupan earlier today, signaling a potential partnership between the university and the City of Milpitas.
                            Vice Mayor Barbadillo was accompanied by his wife, Vilma, and son, Derrick. The visit was coordinated with the Local Government of Dagupan City, represented by Mr. Ryan Ravanzo and Mr. Rex Catubig.'
        ],
        [
            'id' => 11,
            'title' => 'UdD: A Proud Partner in Pangasinan\'s Development',
            'date' => 'April 4, 2025',
            'image' => asset('images/news11.png'),
            'description' => 'Universidad de Dagupan proudly reaffirmed its commitment to research, innovation, and local development through its participation in the recent MOA Signing Ceremony for the CPS Partnerships for Interdisciplinary Studies Research and Special Projects, held on April 4, 2025 at Urduja House, Provincial Capitol Complex, Lingayen.
                            University President Dr. Feliza Arzadon-Sua, together with the VP for Research and Extension Services Dr. Ruby Rosa Cruz and Director for International and Local Linkages Ms. Jasmin Verzola, represented UdD.
                            As one of the seven partner Higher Education Institutions (HEIs) of the Center for Pangasinan Studies (CPS), UdD stands in solidarity with the Provincial Government’s vision for a progressive and research-driven Pangasinan. By actively contributing to interdisciplinary initiatives, the University reinforces its role as a catalyst for positive change in the region.'
        ],
        [
            'id' => 12,
            'title' => 'UDD\'s Annual Date With Special Friend',
            'date' => 'February 14, 2025',
            'image' => asset('images/news12.png'),
            'description' => '"Date with a Special Friend" is an annual event organized by the Supreme Student Council and other school organizations of Universidad de Dagupan. This year, we had the honor of inviting our friends from the Area I Vocational Rehabilitation Center (AVRC) to join in the Valentine\'s Day celebration. The event was filled with fun, laughter, and heartfelt moments as we shared the joy of friendship and love. It was a special occasion that brought the whole university community closer together in the spirit of love and camaraderie.'
        ]

    ];
    $index = $id - 1;
    if (!isset($news[$index])) {
        abort(404);
    }
    return view('aboutpage.news_detail', ['item' => $news[$index]]);
});

// For event details page
Route::get('/event/{id}', function ($id) {
    $events = [
        [
            'id' => 1,
            'title' => 'UdD hosts first Luzon leg of GMA Masterclass Series',
            'date' => 'March 6, 2024',
            'images' => ['images/event1.png'],
            'description' => 'Universidad de Dagupan (UdD) hosted the first Luzon leg of the GMA Masterclass: Eleksyon 2025 Dapat Totoo Series, drawing an enthusiastic crowd at the UdD-Arzadon Gym. Students and learners engaged with top media personalities and industry experts.
                            Speakers included GMA News Online Editor-at-Large Howie Severino, GMA Integrated News Broadcast Journalist Joseph Morong, GMA Integrated News Social Media AVP Aileen Perez, GMA Synergy sportscaster Martin Antonio, and GMA Digital Strategy Senior Manager Bernice Sibucao. Sparkle artist and Miss Universe Philippines Beatrice Luigi Gomez also shared insights on medias role in public awareness.'
        ],
        [
            'id' => 2,
            'title' => 'UdD holds 1st International Research Conference',
            'date' => 'March 27, 2025',
            'images' => ['images/event2.png'],
            'description' => '"Robotics is more than just circuits and code—it\'s about creativity, problem-solving, and the power to shape the future. 🚀🤖 Whether you\'re competing on the grand stage or just beginning your journey, remember that every great inventor started with a simple idea and a passion to explore. Embrace challenges, learn from failures, and push the boundaries of what’s possible. The world needs innovators like you to create, inspire, and transform the future. Keep building, keep dreaming, and never stop believing in your potential!"'
        ],
        [
            'id' => 3,
            'title' => 'Intramural 2025',
            'date' => 'March 31, 2025',
            'images' => ['images/event3.png'],
            'description' => 'Finally, it’s happening! The UdD Intramurals 2025 kicks off on March 31 at 7 AM in the UdD-Arzadon Gym—get ready for an electrifying showdown of sportsmanship and school spirit! This year’s Intrams promises intense competitions, thrilling performances, and unforgettable moments as students from different departments battle it out for pride and glory. Expect exciting games, cheering squads, and a week full of camaraderie, fun, and friendly rivalry that will showcase the true heart of the UdD community.'
        ],
        [
            'id' => 4,
            'title' => 'Hear the Roar of the Savannah! Universidad de Dagupan Cheerdance Competition 2024 Electrifies Universidad de Dagupan Intramurals',
            'date' => 'April 15, 2025',
            'images' => ['images/event4.png'],
            'description' => 'The Universidad de Dagupan Intramurals 2024 roared with excitement as the Cheerdance Competition 2024 took center stage. The event showcased the athleticism, teamwork, and vibrant spirit of the UdD community, leaving the audience in awe with electrifying performances.
                            Competing teams brought their best, displaying intricate formations, synchronized stunts, and high-energy routines. The atmosphere was electric as cheers erupted from the crowd, each team vying for the coveted championship title.
                            The competition served as a platform for students to showcase their talents and dedication to their respective colleges and departments. The synchronized movements, powerful stunts, and infectious enthusiasm were a testament to the hard work and commitment of each team.
                            Beyond the competitive spirit, the Cheerdance Competition fostered a sense of unity and camaraderie within the UdD community. Students came together to support their teams, creating a vibrant and energetic atmosphere that transcended departmental boundaries.
                            As the competition concluded, the judges crowned the champions, recognizing the outstanding performances and unwavering dedication of The School of Information Technology Education (SITE), solidifying their reign as back-to-back champions from last year cheerdance competition. The crowd erupted in a thunderous roar as SITE students celebrated their victory. The event left a lasting impression on everyone involved, further solidifying the importance of teamwork, sportsmanship, and school spirit within the UdD community.'
        ],
        [
            'id' => 5,
            'title' => 'Binibining Universidad de Dagupan 2024: The Grand Coronation',
            'date' => 'April 12, 2024',
            'images' => ['images/event5.png'],
            'description' => 'The Universidad de Dagupan successfully held the Binibining Universidad de Dagupan 2024 pageant, a night of beauty, grace, and talent. The event featured various competitions and was graced by Miss Earth Air 2023, Yllana Marie Aduana, as a special judge. After an evening of elegance and advocacy, Allyssa Marie Tucay from the School of Business and Accountancy was crowned Binibining Universidad de Dagupan 2024, succeeding Donna Rein Nuguid. The pageant not only highlighted beauty and talent but also empowered young women to promote social causes, academic excellence, and community service, leaving a lasting mark of pride and inspiration on the UdD community.'
        ],
        [
            'id' => 6,
            'title' => '40 Years of UdD Excellence: UdD launches their first ever Coffee Table Book!',
            'date' => 'March, 2024',
            'images' => ['images/event6.png'],
            'description' => 'The University of Dagupan (UdD) is celebrating its 40th anniversary with the launch of its first coffee table book, a visual and historical chronicle of the institution’s growth since 1984. The publication highlights UdD’s milestones, achievements, and community impact through photos, stories, and detailed accounts of its evolution. Serving as both a commemorative keepsake and an inspiring record, the book honors the dedication of UdD’s founders, faculty, staff, students, and alumni, marking a proud moment in the university’s legacy.'
        ],
        [
            'id' => 7,
            'title' => 'UdD Celebrates 2nd Year as a University: Another Year of Recollection',
            'date' => 'December 18, 2023',
            'images' => ['images/event7.png'],
            'description' => 'On December 14, 2023, the University of Dagupan (UdD) celebrated its second anniversary as a full-fledged university. From its beginnings as Computronix in 1984 to gaining university status in 2021, UdD has grown through expanded academic programs, research initiatives, and community engagement. The anniversary celebration featured student showcases, food stalls, performances, and the much-anticipated Bandmania, where the School of Humanities emerged as champion. The event highlighted UdD’s commitment to academic excellence, innovation, and community service, marking a vibrant milestone in its journey toward a bright future.'
        ],
        [
            'id' => 8,
            'title' => 'Light Up the Night! UdD Celebrate Our 2nd Uni Anni Lighting Ceremony',
            'date' => 'December 14, 2023',
            'images' => ['images/event8.png'],
            'description' => 'The Universidad de Dagupan (UdD) celebrated its 2nd Uni Anni Lighting Ceremony, marking two years of academic excellence, community engagement, and student success. The event featured a thrilling countdown that lit up the entire campus quadrangle with dazzling LED lights, transforming it into a vibrant spectacle of music and celebration. Beyond the festivities, the ceremony highlighted UdD’s achievements and strengthened unity among students, faculty, staff, alumni, and supporters—serving as both a proud reflection of progress and an inspiring start to future possibilities.
                            Overall, the International Research Conference was a resounding success, showcasing UdD’s dedication to academic excellence and its role as a hub for research and innovation in the region.'
        ],
        [
            'id' => 9,
            'title' => 'Pamaskong Handog 2023: Spreading Holiday Cheer One Blessing at a Time.',
            'date' => 'December 13, 2023',
            'images' => ['images/event9.png'],
            'description' => 'The Universidad de Dagupan (UdD), through its Supreme Student Council, celebrated the holiday season with “Pamaskong Handog 2023” under the theme Liwanag ng Pasko, Kasiyahan sa Bawat Puso (Light of Christmas, Joy in Every Heart). The initiative united students, faculty, and staff in preparing and distributing gift packages to underprivileged families, spreading compassion and holiday cheer. Beyond the gifts, the event fostered unity and highlighted UdD’s commitment to social responsibility, leaving a lasting reminder of the true spirit of giving. The Universidad de Dagupan Robotics Team made a remarkable showing at the 2024 National Robotics Competition held in Manila. Competing against top teams from across the country, the UdD team showcased their innovative designs and technical skills, earning accolades for their creativity and problem-solving abilities. Their performance not only highlighted the university\'s commitment to STEM education but also inspired fellow students to pursue excellence in robotics and technology.'
        ],
        [
            'id' => 10,
            'title' => 'Kick-Off Party for Freshmen and Transferees',
            'date' => 'August 15, 2024',
            'images' => ['images/event10.png'],
            'description' => 'The Universidad de Dagupan is rolling out the red carpet for all freshmen and transferees this Academic Year 2025–2026. Join us for the much-awaited Kick-Off Party on August 4, 8 AM at Leisure Coast Resort, Bonuan Binloc, Dagupan City.
                            Expect a day filled with fun, music, games, and unforgettable memories as we celebrate the beginning of your UdD journey. Don’t miss the chance to meet new friends, bond with fellow Titans, and experience the true UdD spirit.
                            Save the date and let’s make this kick-off an event to remember!
                            #UdDKickOff2025 #TitanSpirit'
        ],
        [
            'id' => 11,
            'title' => 'Freshmen Kick-Off Orientation 2023: U Dare to Dream!',
            'date' => 'September 9, 2023',
            'images' => ['images/event11.png'],
            'description' => 'The Universidad de Dagupan Freshmen Kick-Off Orientation welcomed new students with an exciting mix of performances from the SITE Pep Squad, Koro Universidad, and Steed Dance Company, alongside raffles where 100 tablets were given away. Highlights included a parade for Intramurals 2023 champions, the awarding of Presidential Scholars, and lively campus activities like Banda Mania, a disco party, pool fun, and parlor games. Freshmen also explored student organizations and department booths, giving them a firsthand look at UdD’s vibrant culture. More than just an orientation, the event fostered pride, friendships, and a strong start to their college journey.'
        ],
    ];
    $index = $id - 1;
    if (!isset($events[$index])) {
        abort(404);
    }
    return view('aboutpage.event_detail', ['item' => $events[$index]]);
});

// Application form
Route::get('/apply', [ApplicationController::class, 'create'])->name('application.create');
Route::post('/apply', [ApplicationController::class, 'store'])->name('application.store');
Route::view('/apply/show', 'application.show');


// Admin pages (protected)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/admindashboard', 'admin.dashboard.index')->name('Admin');
    Route::get('/dashboard', [\App\Http\Controllers\DashboardRedirectController::class, 'redirect'])->name('dashboard');
    Route::get('/student-list', [\App\Http\Controllers\StudentListController::class, 'index'])->name('student.list');
    Route::get('/students/{student}', [\App\Http\Controllers\StudentListController::class, 'show'])->name('students.show');
    Route::delete('/students/{student}', [\App\Http\Controllers\StudentListController::class, 'destroy'])->name('students.delete');
    Route::get('/applicants', [ApplicationController::class, 'index'])->name('applicants.list');
    Route::get('/applicants/{application}', [ApplicationController::class, 'show'])->name('applicants.show');
    Route::view('/reports', 'admin.reports.index')->name('reports.list');
    // AJAX partials for admin reports dropdown
        Route::get('/admin/reports/attendance', [\App\Http\Controllers\AttendanceController::class, 'records'])->name('admin.attendance.report');
    Route::get('/admin/reports/evaluation', function() {
        return view('admin.reports.evaluation');
    });
    Route::get('/admin/reports/tasks', function() {
        return view('admin.reports.tasks');
    });
    Route::post('/student-list/add/{id}', [\App\Http\Controllers\StudentListController::class, 'add'])->name('studentlist.add');
    Route::patch('/students/{student}/office', [\App\Http\Controllers\StudentListController::class, 'updateOffice'])->name('students.updateOffice');
    
    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    
    // Redirect root URL to login page
    Route::get('/', function () {
        return redirect()->route('login');
    });
});

// Head Office pages (protected)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/headdashboard', 'headoffice.dashboard.index')->name('Head');
    Route::get('/head-student-list', [\App\Http\Controllers\HeadStudentListController::class, 'index'])->name('head.student.list');
    Route::view('/head-reports', 'headoffice.reports.index')->name('head.reports.list');
    Route::view('/head-reports-alt', 'headoffice.reports.index')->name('head.reports');
    Route::get('/head-students/{student}', [\App\Http\Controllers\HeadStudentListController::class, 'show'])->name('head.students.show');
});

// Student pages (protected)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/studentdashboard', [\App\Http\Controllers\StudentTaskController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student-tasks/month', [\App\Http\Controllers\StudentTaskController::class, 'tasksForMonth']);
    Route::get('/student-tasks/week', [\App\Http\Controllers\StudentTaskController::class, 'tasksForWeek']);
    Route::post('/student-tasks/{id}/status', [\App\Http\Controllers\StudentTaskController::class, 'updateStatus'])->name('student.tasks.status');
    Route::post('/tasks/{id}/reject', [\App\Http\Controllers\StudentTaskController::class, 'rejectTask'])->name('tasks.reject');
    Route::post('/student-tasks/{id}/progress', [\App\Http\Controllers\StudentTaskController::class, 'updateProgress'])->name('student.tasks.progress');
    Route::get('/student-community', [\App\Http\Controllers\CommunityGroupController::class, 'index'])->name('student.community');
    Route::post('/student-community', [\App\Http\Controllers\CommunityGroupController::class, 'store'])->name('student.community.create');
    Route::post('/community/send-message', [App\Http\Controllers\CommunityGroupController::class, 'sendMessage'])->name('community.sendMessage');
    Route::view('/student-calendar', 'students.calendar.index')->name('student.calendar');
    Route::view('/student-tasks/create', 'students.dashboard.create')->name('student.tasks.create');
    Route::post('/student-tasks', [\App\Http\Controllers\StudentTaskController::class, 'store'])->name('student.tasks.store');

     // Community join
    Route::post('/community/join', [\App\Http\Controllers\CommunityGroupController::class, 'join'])->name('community.join');
    // Community group join requests
    Route::post('/community/join-request', [\App\Http\Controllers\CommunityGroupJoinRequestController::class, 'store'])->name('community.join_request');
    Route::get('/community/join-requests', [\App\Http\Controllers\CommunityGroupJoinRequestController::class, 'index'])->name('community.join_requests');
    Route::post('/community/join-request/{id}/action', [\App\Http\Controllers\CommunityGroupJoinRequestController::class, 'update'])->name('community.join_request.action');
    // Add more student routes here as needed
});

// Offices pages (protected)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/offices-dashboard', 'offices.dashboard.index')->name('offices.dashboard');
    Route::get('/offices-student-list', [\App\Http\Controllers\OfficeStudentListController::class, 'index'])->name('offices.studentlists.index');
    Route::get('/evaluation/{student}', [\App\Http\Controllers\EvaluationController::class, 'show'])->name('evaluation.show');
    Route::post('/evaluation/{student}', [\App\Http\Controllers\EvaluationController::class, 'submit'])->name('evaluation.submit');
    Route::get('/attendance', [\App\Http\Controllers\AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/tasks', [\App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks/{id}/verify', [\App\Http\Controllers\TaskController::class, 'verify'])->name('tasks.verify');

    // AJAX endpoint for polling office tasks
    Route::get('/tasks/ajax', [\App\Http\Controllers\TaskController::class, 'ajaxTasks'])->name('tasks.ajax');

    // DTR System Routes
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/api/attendance/today', [AttendanceController::class, 'getTodayRecords'])->name('attendance.today');
    Route::post('/api/attendance/check', [AttendanceController::class, 'checkLastAction'])->name('attendance.check');

    // Tasks Verification
    Route::post('/tasks/{id}/verify', [\App\Http\Controllers\TaskController::class, 'verify'])->name('tasks.verify');

});

// Resource route for applications (for admin CRUD)
Route::resource('applications', ApplicationController::class);

require __DIR__.'/auth.php';