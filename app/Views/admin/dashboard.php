<?= $this->extend('layout/main_admin'); ?>

<?= $this->section('content'); ?>
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg></div>
                            Users List
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="user-management-groups-list.html">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users me-1">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            Manage Groups
                        </a>
                        <a class="btn btn-sm btn-light text-primary" href="user-management-add-user.html">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus me-1">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            Add New User
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                    <div class="datatable-top">
                        <div class="datatable-dropdown">
                            <label>
                                <select class="datatable-selector">
                                    <option value="5">5</option>
                                    <option value="10" selected="">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                </select> entries per page
                            </label>
                        </div>
                        <div class="datatable-search">
                            <input class="datatable-input" placeholder="Search..." type="search" title="Search within table" aria-controls="datatablesSimple">
                        </div>
                    </div>
                    <div class="datatable-container">
                        <table id="datatablesSimple" class="datatable-table">
                            <thead>
                                <tr>
                                    <th data-sortable="true" style="width: 18.06196440342782%;"><a href="#" class="datatable-sorter">User</a></th>
                                    <th data-sortable="true" style="width: 19.05075807514832%;"><a href="#" class="datatable-sorter">Email</a></th>
                                    <th data-sortable="true" style="width: 10.87673038892551%;"><a href="#" class="datatable-sorter">Role</a></th>
                                    <th data-sortable="true" style="width: 31.839156229400135%;"><a href="#" class="datatable-sorter">Groups</a></th>
                                    <th data-sortable="true" style="width: 11.535926170072512%;"><a href="#" class="datatable-sorter">Joined Date</a></th>
                                    <th data-sortable="true" style="width: 8.635464733025708%;"><a href="#" class="datatable-sorter">Actions</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr data-index="0">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-2"><img class="avatar-img img-fluid" src="assets/img/illustrations/profiles/profile-1.png"></div>
                                            Tiger Nixon
                                        </div>
                                    </td>
                                    <td>tiger@email.com</td>
                                    <td>Administrator</td>
                                    <td>
                                        <span class="badge bg-green-soft text-green">Sales</span>
                                        <span class="badge bg-blue-soft text-blue">Developers</span>
                                        <span class="badge bg-red-soft text-red">Marketing</span>
                                        <span class="badge bg-purple-soft text-purple">Managers</span>
                                        <span class="badge bg-yellow-soft text-yellow">Customer</span>
                                    </td>
                                    <td>20 Jun 2021</td>
                                    <td>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="user-management-edit-user.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg></a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg></a>
                                    </td>
                                </tr>
                                <tr data-index="1">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-2"><img class="avatar-img img-fluid" src="assets/img/illustrations/profiles/profile-2.png"></div>
                                            Garrett Winters
                                        </div>
                                    </td>
                                    <td>gwinterse@email.com</td>
                                    <td>Administrator</td>
                                    <td>
                                        <span class="badge bg-green-soft text-green">Sales</span>
                                        <span class="badge bg-blue-soft text-blue">Developers</span>
                                        <span class="badge bg-red-soft text-red">Marketing</span>
                                        <span class="badge bg-purple-soft text-purple">Managers</span>
                                        <span class="badge bg-yellow-soft text-yellow">Customer</span>
                                    </td>
                                    <td>20 Jun 2021</td>
                                    <td>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="user-management-edit-user.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg></a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg></a>
                                    </td>
                                </tr>
                                <tr data-index="2">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-2"><img class="avatar-img img-fluid" src="assets/img/illustrations/profiles/profile-3.png"></div>
                                            Ashton Cox
                                        </div>
                                    </td>
                                    <td>ashtonc@email.com</td>
                                    <td>Registered</td>
                                    <td>
                                        <span class="badge bg-green-soft text-green">Sales</span>
                                        <span class="badge bg-red-soft text-red">Marketing</span>
                                    </td>
                                    <td>20 Jun 2021</td>
                                    <td>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="user-management-edit-user.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg></a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg></a>
                                    </td>
                                </tr>
                                <tr data-index="3">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-2"><img class="avatar-img img-fluid" src="assets/img/illustrations/profiles/profile-4.png"></div>
                                            Cedric Kelly
                                        </div>
                                    </td>
                                    <td>cedrickel@email.com</td>
                                    <td>Registered</td>
                                    <td>
                                        <span class="badge bg-green-soft text-green">Sales</span>
                                        <span class="badge bg-purple-soft text-purple">Managers</span>
                                    </td>
                                    <td>20 Jun 2021</td>
                                    <td>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="user-management-edit-user.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg></a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg></a>
                                    </td>
                                </tr>
                                <tr data-index="4">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-2"><img class="avatar-img img-fluid" src="assets/img/illustrations/profiles/profile-5.png"></div>
                                            Airi Satou
                                        </div>
                                    </td>
                                    <td>asatou@email.com</td>
                                    <td>Registered</td>
                                    <td><span class="badge bg-yellow-soft text-yellow">Customer</span></td>
                                    <td>20 Jun 2021</td>
                                    <td>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="user-management-edit-user.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg></a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg></a>
                                    </td>
                                </tr>
                                <tr data-index="5">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-2"><img class="avatar-img img-fluid" src="assets/img/illustrations/profiles/profile-6.png"></div>
                                            Brielle Williamson
                                        </div>
                                    </td>
                                    <td>bwilliamson@email.com</td>
                                    <td>Registered</td>
                                    <td><span class="badge bg-yellow-soft text-yellow">Customer</span></td>
                                    <td>20 Jun 2021</td>
                                    <td>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="user-management-edit-user.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg></a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg></a>
                                    </td>
                                </tr>
                                <tr data-index="6">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-2"><img class="avatar-img img-fluid" src="assets/img/illustrations/profiles/profile-1.png"></div>
                                            Herrod Chandler
                                        </div>
                                    </td>
                                    <td>harrodc@email.com</td>
                                    <td>Registered</td>
                                    <td><span class="badge bg-green-soft text-green">Sales</span></td>
                                    <td>20 Jun 2021</td>
                                    <td>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="user-management-edit-user.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg></a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg></a>
                                    </td>
                                </tr>
                                <tr data-index="7">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-2"><img class="avatar-img img-fluid" src="assets/img/illustrations/profiles/profile-2.png"></div>
                                            Rhona Davidson
                                        </div>
                                    </td>
                                    <td>rhonadavidson@email.com</td>
                                    <td>Registered</td>
                                    <td>
                                        <span class="badge bg-green-soft text-green">Sales</span>
                                        <span class="badge bg-purple-soft text-purple">Managers</span>
                                    </td>
                                    <td>20 Jun 2021</td>
                                    <td>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="user-management-edit-user.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg></a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg></a>
                                    </td>
                                </tr>
                                <tr data-index="8">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-2"><img class="avatar-img img-fluid" src="assets/img/illustrations/profiles/profile-3.png"></div>
                                            Colleen Hurst
                                        </div>
                                    </td>
                                    <td>churst@email.com</td>
                                    <td>Registered</td>
                                    <td><span class="badge bg-blue-soft text-blue">Developers</span></td>
                                    <td>20 Jun 2021</td>
                                    <td>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="user-management-edit-user.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg></a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg></a>
                                    </td>
                                </tr>
                                <tr data-index="9">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-2"><img class="avatar-img img-fluid" src="assets/img/illustrations/profiles/profile-4.png"></div>
                                            Sonya Frost
                                        </div>
                                    </td>
                                    <td>sfrost@email.com</td>
                                    <td>Registered</td>
                                    <td><span class="badge bg-yellow-soft text-yellow">Customer</span></td>
                                    <td>20 Jun 2021</td>
                                    <td>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="user-management-edit-user.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg></a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="datatable-bottom">
                        <div class="datatable-info">Showing 1 to 10 of 20 entries</div>
                        <nav class="datatable-pagination">
                            <ul class="datatable-pagination-list">
                                <li class="datatable-pagination-list-item datatable-hidden datatable-disabled"><a data-page="1" class="datatable-pagination-list-item-link">‹</a></li>
                                <li class="datatable-pagination-list-item datatable-active"><a data-page="1" class="datatable-pagination-list-item-link">1</a></li>
                                <li class="datatable-pagination-list-item"><a data-page="2" class="datatable-pagination-list-item-link">2</a></li>
                                <li class="datatable-pagination-list-item"><a data-page="2" class="datatable-pagination-list-item-link">›</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>