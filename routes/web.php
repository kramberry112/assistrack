<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
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
    Route::post('/student-list/add/{id}', [\App\Http\Controllers\StudentListController::class, 'add'])->name('studentlist.add');
    Route::patch('/students/{student}/office', [\App\Http\Controllers\StudentListController::class, 'updateOffice'])->name('students.updateOffice');
    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Community join
    Route::post('/community/join', [\App\Http\Controllers\CommunityGroupController::class, 'join'])->name('community.join');
    // Community group join requests
    Route::post('/community/join-request', [\App\Http\Controllers\CommunityGroupJoinRequestController::class, 'store'])->name('community.join_request');
    Route::get('/community/join-requests', [\App\Http\Controllers\CommunityGroupJoinRequestController::class, 'index'])->name('community.join_requests');
    Route::post('/community/join-request/{id}/action', [\App\Http\Controllers\CommunityGroupJoinRequestController::class, 'update'])->name('community.join_request.action');
    
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
    Route::post('/student-tasks/{id}/progress', [\App\Http\Controllers\StudentTaskController::class, 'updateProgress'])->name('student.tasks.progress');
    Route::get('/student-community', [\App\Http\Controllers\CommunityGroupController::class, 'index'])->name('student.community');
    Route::post('/student-community', [\App\Http\Controllers\CommunityGroupController::class, 'store'])->name('student.community.create');
    Route::post('/community/send-message', [App\Http\Controllers\CommunityGroupController::class, 'sendMessage'])->name('community.sendMessage');
    Route::view('/student-calendar', 'students.calendar.index')->name('student.calendar');
    Route::view('/student-tasks/create', 'students.dashboard.create')->name('student.tasks.create');
    Route::post('/student-tasks', [\App\Http\Controllers\StudentTaskController::class, 'store'])->name('student.tasks.store');
    // Add more student routes here as needed
});

// Resource route for applications (for admin CRUD)
Route::resource('applications', ApplicationController::class);

require __DIR__.'/auth.php';