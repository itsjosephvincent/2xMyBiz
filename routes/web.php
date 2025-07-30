<?php

use App\Http\Controllers\Activity\ActivityController;
use App\Http\Controllers\Activity\ActivityLogsController as ActivitiesLogsController;
use App\Http\Controllers\Affiliate\AffiliateController;
use App\Http\Controllers\Audit\AuditController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Deals\DealsController;
use App\Http\Controllers\Email\EmailCategoryController;
use App\Http\Controllers\Email\EmailTemplateController;
use App\Http\Controllers\Facebook\FacebookController;
use App\Http\Controllers\Facebook\PostController;
use App\Http\Controllers\Google\PageSpeedInsightController;
use App\Http\Controllers\Leads\LeadFilesController;
use App\Http\Controllers\Leads\LeadGroupsController;
use App\Http\Controllers\Leads\LeadNotesController;
use App\Http\Controllers\Leads\LeadsController;
use App\Http\Controllers\Leads\OrganizationController;
use App\Http\Controllers\Pipeline\PipelineViewController;
use App\Http\Controllers\Profile\ActivityLogsController;
use App\Http\Controllers\Profile\IntegrationController;
use App\Http\Controllers\Profile\PasswordController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\SocialProfileController;
use App\Http\Controllers\Register\RegisterController;
use App\Http\Controllers\SendNotifications\NotificationController;
use App\Http\Controllers\Settings\BusinessBannerController;
use App\Http\Controllers\Settings\BusinessCalenderController;
use App\Http\Controllers\Settings\BusinessInformationController;
use App\Http\Controllers\Settings\BusinessLogoController;
use App\Http\Controllers\UserRoles\UserRolesController;
use App\Http\Controllers\HelpDesk\HelpdeskController;
use App\Http\Controllers\Instagram\InstagramController;
use App\Http\Controllers\Instagram\PostController as InstagramPostController;
use App\Http\Controllers\Linkedin\LeadsController as LinkedinLeadsController;
use App\Http\Controllers\Linkedin\LinkedInController;
use App\Http\Controllers\Linkedin\PostController as LinkedinPostController;
use App\Http\Controllers\Pages\PageController;
use App\Http\Controllers\Scraper\ScraperController;
use App\Http\Controllers\Settings\AffiliateMarketingController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => '/'], function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/find-facebook-leads', [LeadsController::class, 'index'])->name('find-facebook-leads');
    Route::get('/find-linkedin-leads', [LinkedinLeadsController::class, 'index'])->name('find-linkedin-leads');
    Route::get('/users-and-roles', [UserRolesController::class, 'index'])->name('users-and-roles');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notification');
    Route::get('/notifications/create-new', [NotificationController::class, 'create'])->name('create-notification');
    Route::get('/notifications/{notification}/markAsRead', [NotificationController::class, 'markAsRead'])->name('markAsRead');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/user/profile/{id}', [UserRolesController::class, 'showUser'])->name('get-user-profile');
    Route::post('/reset-password', [AuthController::class, 'getUserByEmail'])->name('search-email');
    Route::post('/update-password', [AuthController::class, 'resetPassword'])->name('change-password');
    Route::post('/auth', [AuthController::class, 'login'])->name('login-user');
    Route::post('/send-notification', [NotificationController::class, 'store'])->name('send-notification');
    Route::post('/update-user', [UserRolesController::class, 'update'])->name('update-user');
    Route::post('/search-user', [UserRolesController::class, 'searchFilter'])->name('search-user-filter');
    Route::post('/search-active-user', [UserRolesController::class, 'searchActiveFilter'])->name('search-active-filter');
    Route::post('/search-inactive-user', [UserRolesController::class, 'searchInactiveFilter'])->name('search-inactive-filter');
});

Route::group(['prefix' => 'inquiry'], function () {
    Route::get('/list', [HelpdeskController::class, 'index'])->name('helpdesk-list');
    Route::get('/list/{id}', [HelpdeskController::class, 'update'])->name('update-helpdesk');
});

Route::group(['prefix' => 'my-profile'], function () {
    Route::get('/personal-info', [ProfileController::class, 'index'])->name('personal-info');
    Route::get('/password-change', [PasswordController::class, 'index'])->name('password-change');
    Route::get('/activity-logs', [ActivityLogsController::class, 'index'])->name('activity-logs');
    Route::get('/integrations', [IntegrationController::class, 'index'])->name('integrations');
    Route::get('/social-profile', [SocialProfileController::class, 'index'])->name('social-profiles');

    Route::get('/social-profile/remove-facebook', [SocialProfileController::class, 'destroyFacebook'])->name('remove-facebook');
    Route::get('/social-profile/remove-twitter', [SocialProfileController::class, 'destroyTwitter'])->name('remove-twitter');
    Route::get('/social-profile/remove-linkedin', [SocialProfileController::class, 'destroyLinkedin'])->name('remove-linkedin');
    Route::get('/social-profile/remove-youtube', [SocialProfileController::class, 'destroyYoutube'])->name('remove-youtube');
    Route::get('/social-profile/remove-instagram', [SocialProfileController::class, 'destroyInstagram'])->name('remove-instagram');

    Route::put('/personal-info/{id}', [ProfileController::class, 'update'])->name('update-personal-info');
    Route::put('/password-change/{id}', [PasswordController::class, 'update'])->name('update-password');

    Route::post('/social-profile/facebook', [SocialProfileController::class, 'storeFacebook'])->name('facebook');
    Route::post('/social-profile/twitter', [SocialProfileController::class, 'storeTwitter'])->name('twitter');
    Route::post('/social-profile/linkedin', [SocialProfileController::class, 'storeLinkedin'])->name('linkedin');
    Route::post('/social-profile/youtube', [SocialProfileController::class, 'storeYoutube'])->name('youtube');
    Route::post('/social-profile/instagram', [SocialProfileController::class, 'storeInstagram'])->name('instagram');
    Route::post('/update-profile-photo', [ProfileController::class, 'udpateProfilePhoto'])->name('update-profile-pic');
});

Route::group(['prefix' => 'facebook'], function () {
    Route::get('/provider', [FacebookController::class, 'provider'])->name('facebook.login');
    Route::get('/callback', [FacebookController::class, 'callback'])->name('facebook_login.callback');
    Route::get('/login-provider', [FacebookController::class, 'redirectToFacebookProvider'])->name('login-with-facebook');
    Route::get('/login-callback', [FacebookController::class, 'handleFacebookProviderCallback'])->name('login-callback');
    Route::get('/post/templates', [PostController::class, 'index'])->name('post-template-list');
    Route::get('/post/template/with-watermark/{id}', [PostController::class, 'createFacebookPostWithWatermark'])->name('template-post-with');
    Route::get('/post/template/without-watermark/{id}', [PostController::class, 'createFacebookPostWithoutWatermark'])->name('template-post-without');
    Route::get('/create/new/post', [PostController::class, 'userCreatePost'])->name('user-create-post');
    Route::get('/show-template/{id}', [PostController::class, 'showTemplate'])->name('show-template');
    Route::get('/delete-post-template/{id}', [PostController::class, 'delete'])->name('delete-template');
    Route::get('/delete-post-category/{id}', [PostController::class, 'deleteCategory'])->name('delete-post-category');
    Route::get('/post-now/{id}', [PostController::class, 'postNow'])->name('post-now');
    Route::post('/create-new/template', [PostController::class, 'storeTemplate'])->name('save-template');
    Route::post('/create-new/template/category', [PostController::class, 'storeCategory'])->name('add-post-category');
    Route::post('/create/new/post/no-watermark', [PostController::class, 'postWithoutWaterMark'])->name('post-no-watermark');
    Route::post('/create/new/post', [PostController::class, 'createNewSchedulePost'])->name('user-created-post');
    Route::post('/template-by-category', [PostController::class, 'showTemplatesByCategory'])->name('get-template-by-category');
});

Route::get('/post/templates', [PostController::class, 'templates'])->name('post-templates');
Route::get('/post/templates/categories', [PostController::class, 'category'])->name('post-template-categories');
Route::get('/post/templates/create-new', [PostController::class, 'create'])->name('create-new-post-template');

Route::group(['prefix' => 'linkedin'], function () {
    Route::get('/provider', [LinkedInController::class, 'provider'])->name('linkedin.login');
    Route::get('/callback', [LinkedInController::class, 'callback'])->name('linkedin_login.callback');
    Route::get('/create-post', [LinkedinPostController::class, 'createLinkedinPost'])->name('make-linkedin-post');
    Route::get('/create/new/post', [LinkedinPostController::class, 'createNewLinkedinPost'])->name('create-new-linkedin-post');
    Route::get('/post/templates', [LinkedinPostController::class, 'index'])->name('linkedin-post-list');
    Route::get('/post/template/with-watermark/{id}', [LinkedinPostController::class, 'createLinkedinPostWithWatermak'])->name('linkedin-post-with');
    Route::get('/post/template/without-watermark/{id}', [LinkedinPostController::class, 'createLinkedinPostWithoutWatermak'])->name('linkedin-post-without');
    Route::post('/post-to-linkedin', [LinkedinPostController::class, 'postTemplate'])->name('post.linkedin');
    Route::post('/linkedin-template-by-category', [PostController::class, 'showTemplatesByCategory'])->name('get-linkedin-template-by-category');
    Route::post('/search-linkedin-leads', [LinkedinLeadsController::class, 'searchLeads'])->name('search-linkedin-leads');
    Route::post('/save-linkedin-leads', [LinkedinLeadsController::class, 'store'])->name('save-linkedin-leads');
});

Route::group(['prefix' => 'instagram'], function () {
    Route::get('/post/templates', [InstagramPostController::class, 'index'])->name('instagram-post-list');
    Route::get('/create/new/post', [InstagramPostController::class, 'createNewLinkedinPost'])->name('create-new-instagram-post');
    Route::get('/provider', [InstagramController::class, 'provider'])->name('instagram.login');
    Route::get('/callback', [InstagramController::class, 'callback'])->name('instagram.callback');
});

Route::group(['prefix' => 'leads'], function () {
    Route::get('/search', [LeadsController::class, 'getPages'])->name('search-leads');
    Route::get('/my-leads', [LeadsController::class, 'leadList'])->name('my-leads');
    Route::get('/lead-profile/p/{id}', [LeadsController::class, 'show'])->name('lead-profile');
    Route::get('/update-activity-status/{id}', [ActivityController::class, 'updateStatus'])->name('update-activity-status');
    Route::get('/email/el/{id}', [LeadsController::class, 'getLeadEmailPage'])->name('lead-email-page');
    Route::get('/increase/contact-count', [LeadsController::class, 'contactCount'])->name('increment-contact-count');
    Route::get('/get-lead-note/{id}', [LeadNotesController::class, 'show'])->name('show-lead-note');
    Route::get('/delete-lead/{id}', [LeadsController::class, 'deleteLead'])->name('delete-lead');
    Route::post('/save-leads', [LeadsController::class, 'store'])->name('save-leads');
    Route::post('/save-leads-bulk', [LeadsController::class, 'saveBulkLeads'])->name('bulk-save-leads');
    Route::post('/block-leads', [LeadsController::class, 'block'])->name('block-leads');
    Route::post('/save-activity', [ActivityController::class, 'store'])->name('save-activity');
    Route::post('/upload-files', [LeadFilesController::class, 'store'])->name('upload-file');
    Route::post('/save-note', [LeadNotesController::class, 'store'])->name('save-note');
    Route::post('/search-my-lead', [LeadsController::class, 'searchFilter'])->name('search-my-lead');
    Route::post('/filter-my-lead', [LeadsController::class, 'filterBy'])->name('filter-my-lead');
    Route::post('/export-leads', [LeadsController::class, 'exportToCsv'])->name('export-to-csv');
    Route::post('/update-lead-stage', [LeadsController::class, 'updateStage'])->name('update-lead-stage');
    Route::post('/update-single-lead-stage', [LeadsController::class, 'updateSingleStage'])->name('update-single-lead-stage');
    Route::post('/update-lead-noted', [LeadNotesController::class, 'update'])->name('update-lead-note');
    Route::post('/delete-selected-leads', [LeadsController::class, 'massDeleteLead'])->name('mass-remove-leads');
    Route::put('/update-lead/{id}', [LeadsController::class, 'update'])->name('update-lead');
    Route::put('/update-lead-organization/{id}', [LeadsController::class, 'updateOrganization'])->name('update-lead-organization');
    Route::put('/update-lead-group-id/{id}', [LeadsController::class, 'updateLeadGroup'])->name('update-lead-group-id');
    Route::put('/update-lead-address/{id}', [LeadsController::class, 'updateAddress'])->name('update-lead-address');
});

Route::group(['prefix' => 'deals'], function () {
    Route::get('/pipeline/view', [PipelineViewController::class, 'index'])->name('pipeline-view');
    Route::get('/deals/list', [DealsController::class, 'index'])->name('deals');
    Route::get('/delete-deal/{id}', [DealsController::class, 'destroy'])->name('delete-deal');
    Route::post('/get-deal', [DealsController::class, 'getDeal'])->name('get-deal');
    Route::post('/create-deal', [DealsController::class, 'store'])->name('create-deal');
    Route::post('/pipeline/filter', [PipelineViewController::class, 'filter'])->name('filter-pipline');
    Route::put('/update-deal', [DealsController::class, 'updateDeal'])->name('update-deal');
    Route::put('/mark-as-lost', [PipelineViewController::class, 'update'])->name('mark-lost');
});

Route::group(['prefix' => 'lead-groups'], function () {
    Route::get('/list', [OrganizationController::class, 'index'])->name('my-organizations');
    Route::get('/group/{id}', [OrganizationController::class, 'show'])->name('organization-profile');
    Route::get('/remove-leads-from-group/{id}', [OrganizationController::class, 'removeLeadFromGroup'])->name('remove-leads-from-leadgroup');
    Route::get('/remove-lead-group/{id}', [OrganizationController::class, 'destroy'])->name('remove-leadgroup');
    Route::post('/save-leadgroup', [OrganizationController::class, 'store'])->name('save-organization');
    Route::post('/update-leadgroup', [OrganizationController::class, 'massUpdateOrganization'])->name('mass-update-organization');
    Route::post('/update-leadstage', [OrganizationController::class, 'massUpdateStage'])->name('mass-update-stage');
    Route::post('/update-leads-deal', [OrganizationController::class, 'massUpdateDeal'])->name('mass-update-deal');
    Route::put('/update-leadgroup/{id}', [OrganizationController::class, 'update'])->name('update-organization');
    Route::put('/add-leads-to-group/{id}', [OrganizationController::class, 'addLeadToLeadGroup'])->name('add-leads-to-leadgroup');
});

Route::group(['prefix' => 'pipeline-category'], function () {
    Route::get('/list', [LeadGroupsController::class, 'index'])->name('lead-groups');
    Route::get('/delete-pipeline-category/{leadGroupId}', [LeadGroupsController::class, 'destroy'])->name('delete-lead-group');
    Route::post('/save', [LeadGroupsController::class, 'store'])->name('save-lead-group');
});

Route::group(['prefix' => 'emails'], function () {
    Route::get('/category-list', [EmailCategoryController::class, 'index'])->name('email-categories');
    Route::get('/template-list', [EmailTemplateController::class, 'index'])->name('email-templates');
    Route::get('/template/create-new', [EmailTemplateController::class, 'create'])->name('create-email');
    Route::get('/delete-category/{id}', [EmailCategoryController::class, 'destroy'])->name('delete-category');
    Route::get('/delete-email/{id}', [EmailTemplateController::class, 'destroy'])->name('delete-email');
    Route::get('/edit-email/{id}', [EmailTemplateController::class, 'editEmail'])->name('edit-email');
    Route::post('/get-email', [EmailTemplateController::class, 'findEmail'])->name('get-email');
    Route::post('/add-category', [EmailCategoryController::class, 'store'])->name('add-category');
    Route::post('/add-template', [EmailTemplateController::class, 'store'])->name('add-template');
    Route::post('/get-emails-by-category', [EmailTemplateController::class, 'getEmailByCategory'])->name('get-emails-by-category');
    Route::post('/preview-results', [EmailTemplateController::class, 'convertShortCodes'])->name('preview');
    Route::put('/e/update/{id}', [EmailTemplateController::class, 'update'])->name('update-template');
});

Route::group(['prefix' => 'audits'], function () {
    Route::get('/lead/{id}', [AuditController::class, 'index'])->name('audit-page');
    Route::put('/lead/update-audit/{id}', [AuditController::class, 'update'])->name('update-audit');
});

Route::group(['prefix' => 'settings'], function () {
    Route::get('/business/information', [BusinessInformationController::class, 'index'])->name('business-information');
    Route::get('/business/logo', [BusinessLogoController::class, 'index'])->name('business-logo');
    Route::get('/business/calendar', [BusinessCalenderController::class, 'index'])->name('business-calender');
    Route::get('/business/banner', [BusinessBannerController::class, 'index'])->name('business-banner');
    Route::get('/affiliate-marketing/2xmyleads', [AffiliateMarketingController::class, 'myleads'])->name('myleads');
    Route::get('/affiliate-marketing/kartra', [AffiliateMarketingController::class, 'kartra'])->name('kartra');
    Route::get('/remove/calendar-link', [BusinessCalenderController::class, 'destroy'])->name('remove-calendar-link');
    Route::post('/business/update-logo', [BusinessLogoController::class, 'update'])->name('update-business-logo');
    Route::post('/business/update-banner', [BusinessBannerController::class, 'update'])->name('update-business-banner');
    Route::put('/business/update-calendar-link/{id}', [BusinessCalenderController::class, 'update'])->name('update-business-calendar');
    Route::put('/business/update-myleads-link/{id}', [AffiliateMarketingController::class, 'updateMyLeads'])->name('update-myleads-link');
    Route::put('/business/update-kartra-link/{id}', [AffiliateMarketingController::class, 'updateKartra'])->name('update-kartra-link');
    Route::put('/business/update-information/{id}', [BusinessInformationController::class, 'update'])->name('update-business-information');
});

Route::group(['prefix' => 'activity-logs'], function () {
    Route::get('/', [ActivitiesLogsController::class, 'index'])->name('activity-list');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/login-as-user/{id}', [UserRolesController::class, 'loginAsUser'])->name('login-as-user');
    Route::post('/update-info', [UserController::class, 'updateUserDetails'])->name('update-info');
    Route::post('/export-info', [UserController::class, 'exportUser'])->name('export-user');
    Route::post('/create-new-user', [UserRolesController::class, 'createUser'])->name('create-user');
    Route::put('/update-user/{id}', [UserController::class, 'update'])->name('update-user');
});

Route::group(['prefix' => 'affiliate'], function () {
    Route::get('/list', [AffiliateController::class, 'index'])->name('affiliate-list');
    Route::get('/partner/{id}', [AffiliateController::class, 'show'])->name('affiliate');
    Route::get('/delete/{id}', [AffiliateController::class, 'destroy'])->name('delete-affiliate');
    Route::post('/create-affiliate', [AffiliateController::class, 'store'])->name('add-affiliate');
    Route::post('/add-user-affiliate', [AffiliateController::class, 'addUserAffiliate'])->name('add-user-affiliate');
});

Route::group(['prefix' => 'page'], function () {
    Route::get('/list', [PageSpeedInsightController::class, 'index'])->name('page.list');
    Route::get('/insights/{id}', [PageSpeedInsightController::class, 'show'])->name('page.insights');
});

Route::get('/scrape', [ScraperController::class, 'googleSearchApi']);
