@extends('layouts.client')

@push('styles')
<style>
  .toppers {
    position: absolute;
    /* top: 300px; */
    left: 25%;
    margin: auto;
    top: 33%;
    z-index: 1;
    
  }
</style>
@endpush
@section('content')


<!-- ======= Pass Section ======= -->
<section id="hero2" class="d-flex align-items-center px-5 text-white">
  <div class="row">
    <div class="col-lg-12 pt-5" data-aos="fade-up">
      <div>
        <h1>Camarines Norte Online Travel Pass</h1>
        <small>Lorem ipsum dolor sit amet, tota senserit percipitur ius ut, usu et fastidii forensibus voluptatibus.
          His ei nihil feugait</small>
      </div>
    </div>
  </div>
</section>

<section id="contact" class="contact">
  <div class="container" data-aos="fade-up">
    <div class="row">

      <form method="POST" action="{{ route('travel-pass-application.store') }}" enctype="multipart/form-data"
        id="travelPassForm">
        @csrf
        <!-- {{$errors}} -->
        <div class="card text-dark bg-light">
          <div class="card-body">
            <h5 class="card-title">Basic Informations</h5>
            <p class="card-text">Some quick example text card's
              content.</p>

            <div class="mb-3 row">
              <div class="col-6">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" placeholder="First Name" id="fname" name="fname"
                  aria-describedby="fname">
              </div>
              <div class="col-6">
                <label for="mname" class="form-label">Middle Name</label>
                <input type="text" class="form-control" required placeholder="Middle Name" id="mname" name="mname"
                  aria-describedby="mname">
              </div>
            </div>
            <div class="mb-2 row">
              <div class="col-6">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" required placeholder="Last Name" id="lname" name="lname"
                  aria-describedby="lname">
              </div>
              <div class="col-6">
                <label for="suffix" class="form-label">Suffix</label>
                <input type="text" class="form-control" placeholder="Suffix" id="suffix" name="suffix"
                  aria-describedby="suffix" maxlength="10">
                <div id="textHelp" class="form-text">e.g. Jr, Sr, II, III...</div>
              </div>
            </div>

            <div class="mb-3 row">
              <div class="col-6">
                <label for="sex" class="form-label">Sex</label>
                <select class="form-select form-select" aria-label=".form-select-sm example" id="sex" name="sex">
                  <option value="" disabled="" selected="">Choose</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
              <div class="col-2">
                <label for="month" class="form-label">Month</label>
                <select class="form-select form-select" aria-label=".form-select-sm example" name="month" id="month">
                  <option value="" disabled="" selected="">Choose</option>
                </select>
              </div>
              <div class="col-2">
                <label for="day" class="form-label">Day</label>
                <select class="form-select form-select" aria-label=".form-select-sm example" name="day" id="day">
                  <option value="" disabled="" selected="">Choose</option>
                </select>
              </div>
              <div class="col-2">
                <label for="year" class="form-label">Year</label>
                <select class="form-select form-select" aria-label=".form-select-sm example" name="year" id="year">
                  <option value="" disabled="" selected="">Choose</option>
                </select>
              </div>
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" required placeholder="Address" id="address" name="address"
                aria-describedby="address">
            </div>
            <div class="row">
              <div class="mb-3 col-6">
                <label for="contact_no" class="form-label">Contact Number</label>
                <input type="tel" class="form-control" id="contact_no" name="contact_no" id="contact_no"
                  aria-describedby="contact_no" required placeholder="Contact Number" maxlength="11">
                <div id="textHelp" class="form-text">Start with 09...</div>
                <!-- @error('contact_no')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror -->

              </div>
              <div class="mb-3 col-6">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                  required autocomplete="email" placeholder="Email Address" />

              </div>

            </div>
            <div class="mb-3 row">
              <div class="col-6">
                <label for="occupation" class="form-label">Occupation</label>
                <input type="text" class="form-control" id="occupation" aria-describedby="occupation" id="occupation"
                  name="occupation" required placeholder="Occupation" maxlength="255">
              </div>
              <div class="col-6">
                <label for="workplace" class="form-label">Work Place</label>
                <input type="text" class="form-control" id="workplace" aria-describedby="workplace" id="workplace"
                  name="workplace" required placeholder="Workplace" maxlength="255">
              </div>
            </div>
          </div>
        </div>

        <!-- Travel Informations -->
        <div class="card text-dark bg-light mt-3">
          <div class="card-body">
            <h5 class="card-title">Travel Informations</h5>
            <p class="card-text">Some quick example text card's
              content.</p>

            <div class="mb-3">
              <label for="purpose" class="form-label">Purpose of Travel</label>
              <input type="text" class="form-control" required placeholder="Purpose of Travel" id="purpose"
                name="purpose" aria-describedby="purpose">
            </div>

            <div class="mb-3">
              <label for="dot" class="form-label">Details of Travel</label>
              <select class="form-select form-select" aria-label=".form-select-sm example" id="travel_details"
                name="travel_details">
                <option value="" disabled="" selected="">Choose</option>
                <option value="Going to Camarines Norte">Going to Camarines Norte</option>
                <option value="Leaving Camarines Norte">Leaving Camarines Norte</option>
              </select>
            </div>

            <div class="mb-3 row">
              <label for="origin" class="form-label">Point of Origin</label>
              <div class="col-3">
                <input type="text" class="form-control" required placeholder="Purok/Office/Establishment" id="po_street"
                  name="po_street" aria-describedby="po_street">
              </div>
              <div class="col-3">
                <input type="text" class="form-control" required placeholder="Barangay" id="po_brgy" name="po_brgy"
                  aria-describedby="po_brgy">
              </div>
              <div class="col-3" id="origin_muni">
                <input type="text" class="form-control" required placeholder="City/Municipality" id="po_city"
                  name="po_city" aria-describedby="po_city">
              </div>
              <div class="col-3">
                <input type="text" class="form-control" required placeholder="Province" id="po_province"
                  name="po_province" aria-describedby="po_province">
              </div>
            </div>

            <div class="mb-3 row">
              <label for="origin" class="form-label">Point of Destination</label>
              <div class="col-3">
                <input type="text" class="form-control" required placeholder="Purok/Office/Establishment" id="pd_street"
                  name="pd_street" aria-describedby="pd_street" />
              </div>
              <div class="col-3">
                <input type="text" class="form-control" required placeholder="Barangay" id="pd_brgy" name="pd_brgy"
                  aria-describedby="pd_brgy" />
              </div>
              <div class="col-3">
                <select class="form-select form-select" aria-label=".form-select-sm example" id="pd_city"
                  name="pd_city">
                  <option value="0" disabled="" selected="">Choose</option>
                  <option value="Basud">Basud</option>
                  <option value="Capalonga">Capalonga</option>
                  <option value="Daet">Daet</option>
                  <option value="Jose Panganiban">Jose Panganiban</option>
                  <option value="Labo">Labo</option>
                  <option value="Mercedes">Mercedes</option>
                  <option value="Paracale">Paracale</option>
                  <option value="San Lorenzo Ruiz">San Lorenzo Ruiz</option>
                  <option value="San Vicente">San Vicente</option>
                  <option value="Santa Elena">Santa Elena</option>
                  <option value="Talisay">Talisay</option>
                  <option value="Vinzons">Vinzons</option>
                  <!-- <input type="text" class="form-control" required placeholder="Province" id="pd_province"
                  name="pd_province" aria-describedby="pd_province"> -->
                </select>
              </div>
              <div class="col-3">
                <input type="text" class="form-control" required placeholder="Province" id="pd_province"
                  name="pd_province" aria-describedby="pd_province" value="Camarines Norte">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="occupation" class="form-label">Vehicle Details</label>
              <div class="col-6">
                <select class="form-select form-select" aria-label=".form-select-sm example" id="vehicle"
                  name="vehicle">
                  <option value="0" disabled="" selected="">Choose</option>
                  <option value="Motorcycle">Motorcycle</option>
                  <option value="Tricycle">Tricycle</option>
                  <option value="Public Utility Van">Public Utility Van</option>
                  <option value="Public Utility Bus">Public Utility Bus</option>
                  <option value="Private Car">Private Car</option>
                  <option value="10 Wheeler Truck">10 Wheeler Truck</option>
                  <option value="6 Wheeler Truck">6 Wheeler Truck</option>
                  <option value="4 Wheeler Truck">4 Wheeler Truck</option>
                  <option value="Government Vehicle">Government Vehicle</option>
                  <option value="Others">Others</option>
                </select>
              </div>
              <div class="col-6">
                <input type="text" class="form-control" id="plate_no" name="plate_no" aria-describedby="plate_no"
                  required placeholder="Plate Number" maxlength="10">
              </div>
            </div>

          </div>
        </div>

        <!-- Classifications -->
        <div class="card text-dark bg-light mt-3">
          <div class="card-body">
            <h5 class="card-title">Classifications</h5>
            <p class="card-text">Some quick example text card's
              content.</p>

            <div class="mb-3">
              <label for="classification" class="form-label">Classification</label>
              <select class="form-select form-select" aria-label=".form-select-sm example" id="classification"
                name="classification">
                <option value="0" disabled="" selected="">Choose</option>
                <option value="Authorized Person Outside of Residence (APOR)">Authorized Person Outside of Residence
                  (APOR)</option>
                <option value="Business">Business</option>
                <option value="Locally Stranded Individual (LSI)">Locally Stranded Individual (LSI)</option>
                <option value="Medical">Medical</option>
                <option value="Personal">Personal</option>
                <option value="Trucking">Trucking</option>
                <option value="Tourist (Family)">Tourist (Family)</option>
                <option value="Tourist (Individual)">Tourist (Individual)</option>
                <option value="Others">Others, please specify</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="booked_date" class="form-label">Date of Arrival in Camarines Norte</label>
              <input type="date" class="form-control" required placeholder="Date of Arrival in Camarines Norte"
                id="booked_date" name="booked_date" aria-describedby="booked_date">
            </div>

          </div>
        </div>

        <!-- Attachments -->
        <div class="card text-dark bg-light mt-3">
          <div class="card-body">
            <h5 class="card-title">Attachments</h5>
            <div class="my-3">
              <label for="attachment1" class="form-label">Valid ID or Certificate of Employment</label>
              <input type="file" class="form-control" id="attachment1" aria-describedby="attachment1"
                aria-label="attachment1" id="attachment1" name="attachment1" accept="image/*">
            </div>
            <div class="mb-3">
              <label for="attachment2" class="form-label">Rapid Test Result or Vaccination Card</label>
              <input type="file" class="form-control" id="attachment2" aria-describedby="attachment2"
                aria-label="attachment2" id="attachment2" name="attachment2" accept="image/*">
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input hidden" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">By clicking "Submit", you agree to the
                <a href="#" data-bs-toggle="modal" data-bs-target="#terms"> Terms and Privacy Policy</a>
              </label>
            </div>

          </div>

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

  </div>
</section>
<!-- End Contact Section -->
@include('modal.terms')
@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
<script src="/js/client/validation.js"></script>

<script>
  $('#travel_details').change(function () {
    const travel_details = $('#travel_details').val()

    if (travel_details == "Leaving Camarines Norte") {
      console.log(travel_details)
      $("#po_city").replaceWith(` <select class="form-select form-select" aria-label=".form-select-sm example" id="po_city"
                  name="po_city">
                  <option value="0" disabled="" selected="">Choose</option>
                  <option value="Basud">Basud</option>
                  <option value="Capalonga">Capalonga</option>
                  <option value="Daet">Daet</option>
                  <option value="Jose Panganiban">Jose Panganiban</option>
                  <option value="Labo">Labo</option>
                  <option value="Mercedes">Mercedes</option>
                  <option value="Paracale">Paracale</option>
                  <option value="San Lorenzo Ruiz">San Lorenzo Ruiz</option>
                  <option value="San Vicente">San Vicente</option>
                  <option value="Santa Elena">Santa Elena</option>
                  <option value="Talisay">Talisay</option>
                  <option value="Vinzons">Vinzons</option>
                  <!-- <input type="text" class="form-control" required placeholder="Province" id="pd_province"
                  name="pd_province" aria-describedby="pd_province"> -->
                </select>`);
      $("#pd_city").replaceWith(`<input type="text" class="form-control" required placeholder="City/Municipality" id="pd_city"
                  name="pd_city" aria-describedby="pd_city">`);
      $('#pd_province').val('')
      $('#po_province').val('Camarines Norte')
    } else if (travel_details == "Going to Camarines Norte") {
      console.log(travel_details)
      $("#pd_city").replaceWith(` <select class="form-select form-select" aria-label=".form-select-sm example" id="pd_city"
                  name="po_city">
                  <option value="0" disabled="" selected="">Choose</option>
                  <option value="Basud">Basud</option>
                  <option value="Capalonga">Capalonga</option>
                  <option value="Daet">Daet</option>
                  <option value="Jose Panganiban">Jose Panganiban</option>
                  <option value="Labo">Labo</option>
                  <option value="Mercedes">Mercedes</option>
                  <option value="Paracale">Paracale</option>
                  <option value="San Lorenzo Ruiz">San Lorenzo Ruiz</option>
                  <option value="San Vicente">San Vicente</option>
                  <option value="Santa Elena">Santa Elena</option>
                  <option value="Talisay">Talisay</option>
                  <option value="Vinzons">Vinzons</option>
                  <!-- <input type="text" class="form-control" required placeholder="Province" id="pd_province"
                  name="pd_province" aria-describedby="pd_province"> -->
                </select>`);
      $("#po_city").replaceWith(`<input type="text" class="form-control" required placeholder="City/Municipality" id="po_city"
                  name="po_city" aria-describedby="po_city">`);
      $('#po_province').val('')
      $('#pd_province').val('Camarines Norte')
    } else { }
  })
</script>

<script>
  let nowY = new Date().getFullYear();
  let options_year = "";

  for (let Y = nowY; Y >= 1930; Y--) {
    options_year += "<option value=" + Y + ">" + Y + "</option>";
  }

  $("#year").append(options_year);
</script>

<script>
  const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];
  let options_month = "";

  for (let M = 0; M <= 11; M++) {
    options_month += "<option value=" + monthNames[M] + ">" + monthNames[M] + "</option>";
  }
  $("#month").append(options_month);
</script>

<script>
  let options_day = "";

  for (let D = 1; D <= 31; D++) {
    options_day += "<option value=" + D + ">" + D + "</option>";
  }
  $("#day").append(options_day);
</script>

<script>
  let today = new Date().toISOString().split('T')[0];
  document.getElementsByName("booked_date")[0].setAttribute('min', today);
</script>
<script>
  $(document).ready(function () {
    $('#form').validate({
      rules: {
        fname: {
          required: true
        },
        email: {
          required: true,
          email: true
        },
        number: {
          required: true,
          digits: true

        },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>
@endpush