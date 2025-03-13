<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>Tables | PlainAdmin Demo</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{asset('assets/css_admin/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css_admin/lineicons.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css_admin/materialdesignicons.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css_admin/fullcalendar.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css_admin/main.css')}}" />
    <link href="{{asset('assets/fontawesome-free/css/all.css')}}" rel="stylesheet"/>
  </head>
  <body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
      <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->

    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">

      <!-- ========== table components start ========== -->

      <div style="display: flex;align-items: center;justify-content: center;flex-direction: row;flex-wrap: wrap;">
       <div class="card align-items-center" style="width: 60%">
         <div class="row align-items-center"style="justify-content: center;">
          <img src="{{asset('assets/img/logo_ministere.svg')}}" alt="" style="width: 60%"/>


          <div >
          <form class="row g-3 needs-validation" style="padding: 5px 10px 15px 10px; " enctype="multipart/form-data"  novalidate>
            <div class="col-md-3">
              <label for="validationCustom01" class="form-label">Nom</label>
              <input type="text" class="form-control" id="validationCustom01" value="Mark" required>
              <div class="valid-feedback">
              
              </div>
            </div>
            <div class="col-md-3">
              <label for="validationCustom02" class="form-label">Prenom</label>
              <input type="text" class="form-control" id="validationCustom02" value="Otto" required>
              <div class="valid-feedback">
               
              </div>
            </div>
            <div class="col-md-6">
              <label for="validationCustomUsername" class="form-label">Local Email</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                <span class="input-group-text" id="inputGroupPrepend">@mcomm.local</span>
               
                <div class="invalid-feedback" >
                 
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <label for="validationCustom03" class="form-label">Sous Direction</label>
              <select class="form-select" id="validationCustom04" required>
                <option selected disabled value="">Choisir...</option>
                <option>...</option>
              </select>
              <div class="invalid-feedback">
                Please provide a valid city.
              </div>
            </div>

            <div class="col-md-4">
              <label for="validationCustom03" class="form-label">Position</label>
              <select class="form-select" id="validationCustom04" required>
                <option selected disabled value="">Choisir...</option>
                <option>...</option>
              </select>
              <div class="invalid-feedback">
                Please provide a valid city.
              </div>
            </div>

            <div class="col-md-3">
              <label for="validationCustom04" class="form-label">Previlaige</label>
              <select class="form-select" id="validationCustom04" required>
                <option selected disabled value="">Choose...</option>
                <option>...</option>
              </select>
              <div class="invalid-feedback">
                
              </div>
            </div>
            <div class="col-md-6">
              <label for="validationCustom05" class="form-label">Le Code </label>
              <input type="text" class="form-control" id="validationCustom05" required>
              <div class="invalid-feedback">
               
              </div>
            </div>
            <div class="col-12">
              <div class="form-check">
                <input class="form-control" type="file" value="" id="file" required>
                <label class="form-check-label" for="invalidCheck">
                  Ajouter Decision
                </label>
                <div class="invalid-feedback">
                  You must agree before submitting.
                </div>
              </div>
            </div>
            <div class="col-12">
              <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
          </form>
          </div>


         </div>
        </div>
      </div>
      <section class="table-components">
       


        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2>Tables</h2>
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="#0">Dashboard</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Tables
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->

          <!-- ========== tables-wrapper start ========== -->
          <div class="tables-wrapper">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-style mb-30">
                  <h6 class="mb-10">Data Table</h6>
                  <p class="text-sm mb-20">
                    For basic styling—light padding and only horizontal
                    dividers—use the class table.
                  </p>
                  <div class="table-wrapper table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                            <h6>Code</h6>
                          </th>
                          <th>
                            <h6>nom complet</h6>
                          </th>
                          <th>
                            <h6>Email</h6>
                          </th>
                          <th>
                            <h6>Sous Direction</h6>
                          </th>
                          <th>
                            <h6>Privilège</h6>
                          </th>
                          <th>
                            <h6>Action</h6>
                          </th>
                        </tr>
                        <!-- end table row-->
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="employee-image">
                              <img src="assets/images/lead/lead-1.png" alt="" />
                            </div>
                          </td>
                          <td class="min-width">
                            <p>Esther Howard</p>
                          </td>
                          <td class="min-width">
                            <p><a href="#0">yourmail@gmail.com</a></p>
                          </td>
                          <td class="min-width">
                            <p>Admin Dashboard Design</p>
                          </td>
                          <td class="min-width">
                            <span class="status-btn active-btn">Active</span>
                          </td>
                          <td>
                            <div class="action">
                              <button class="text-danger">
                                <i class="lni lni-trash-can"></i>
                              </button>
                            </div>
                          </td>
                        </tr>
                        <!-- end table row -->
                        <tr>
                          <td>
                            <div class="employee-image">
                              <img src="assets/images/lead/lead-2.png" alt="" />
                            </div>
                          </td>
                          <td class="min-width">
                            <p>D. Jonathon</p>
                          </td>
                          <td class="min-width">
                            <p><a href="#0">yourmail@gmail.com</a></p>
                          </td>
                          <td class="min-width">
                            <p>React Dashboard</p>
                          </td>
                          <td class="min-width">
                            <span class="status-btn active-btn">Active</span>
                          </td>
                          <td>
                            <div class="action">
                              <button class="text-danger">
                                <i class="lni lni-trash-can"></i>
                              </button>
                            </div>
                          </td>
                        </tr>
                        <!-- end table row -->
                        <tr>
                          <td>
                            <div class="employee-image">
                              <img src="assets/images/lead/lead-3.png" alt="" />
                            </div>
                          </td>
                          <td>
                            <p>John Doe</p>
                          </td>
                          <td>
                            <p><a href="#0">yourmail@gmail.com</a></p>
                          </td>
                          <td>
                            <p>Bootstrap Template</p>
                          </td>
                          <td>
                            <span class="status-btn success-btn">Done</span>
                          </td>
                          <td>
                            <div class="action">
                              <button class="text-danger">
                                <i class="lni lni-trash-can"></i>
                              </button>
                            </div>
                          </td>
                        </tr>
                        <!-- end table row -->
                        <tr>
                          <td>
                            <div class="employee-image">
                              <img src="assets/images/lead/lead-4.png" alt="" />
                            </div>
                          </td>
                          <td>
                            <p>Rayhan Jamil</p>
                          </td>
                          <td>
                            <p><a href="#0">yourmail@gmail.com</a></p>
                          </td>
                          <td>
                            <p>Css Grid Template</p>
                          </td>
                          <td>
                            <span class="status-btn info-btn">Pending</span>
                          </td>
                          <td>
                            <div class="action">
                              <button class="text-danger">
                                <i class="lni lni-trash-can"></i>
                              </button>
                            </div>
                          </td>
                        </tr>
                        <!-- end table row -->
                        <tr>
                          <td>
                            <div class="employee-image">
                              <img src="assets/images/lead/lead-5.png" alt="" />
                            </div>
                          </td>
                          <td>
                            <p>Esther Howard</p>
                          </td>
                          <td>
                            <p><a href="#0">yourmail@gmail.com</a></p>
                          </td>
                          <td>
                            <p>Admin Dashboard Design</p>
                          </td>
                          <td>
                            <span class="status-btn close-btn">Close</span>
                          </td>
                          <td>
                            <div class="action">
                              <button class="text-danger">
                                <i class="lni lni-trash-can"></i>
                              </button>
                            </div>
                          </td>
                        </tr>
                        <!-- end table row -->
                        <tr>
                          <td>
                            <div class="employee-image">
                              <img src="assets/images/lead/lead-6.png" alt="" />
                            </div>
                          </td>
                          <td>
                            <p>Anee Doe</p>
                          </td>
                          <td>
                            <p><a href="#0">yourmail@gmail.com</a></p>
                          </td>
                          <td>
                            <p>Space Template Update</p>
                          </td>
                          <td>
                            <span class="status-btn active-btn">Active</span>
                          </td>
                          <td>
                            <div class="action">
                              <button class="text-warning">
                                <i class="fas fa-user-edit"></i>
                              </button>
                              <button class="text-danger">
                                <i class="lni lni-trash-can"></i>
                              </button>
                            </div>
                          </td>
                        </tr>
                        <!-- end table row -->
                      </tbody>
                    </table>
                    <!-- end table -->
                  </div>
                </div>
                <!-- end card -->
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== tables-wrapper end ========== -->
        </div>
        <!-- end container -->
      </section>
      <!-- ========== table components end ========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="{{asset('assets/js_admin/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js_admin/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js_admin/dynamic-pie-chart.js')}}"></script>
    <script src="{{asset('assets/js_admin/moment.min.js')}}"></script>
    <script src="{{asset('assets/js_admin/fullcalendar.js')}}"></script>
    <script src="{{asset('assets/js_admin/jvectormap.min.js')}}"></script>
    <script src="{{asset('assets/js_admin/world-merc.js')}}"></script>
    <script src="{{asset('assets/js_admin/polyfill.js')}}"></script>
    <script src="{{asset('assets/js_admin/main.js')}}"></script>
  </body>
</html>
