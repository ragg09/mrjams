<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
    <link rel="icon" href="{{asset('./images/mrjams/mr-jams-logo.png')}}">
    <title>MR. JAMS</title>

     {{-- jquery 3.6.0 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="{{asset('./css/registration/terms.css')}}">

</head>
<body>

    <section>
        <div class="container" style="width: 80%;">
            <form action="#" class="login-form" id="main_form">
              @csrf

              <div class="login-sec">

                <h2>Terms and Condition</h2>

                      <img src="{{ URL::asset('images/mrjams/logowithname.PNG') }}" class="center" style="width: 250px;">
                      {{-- <p>Appointment and Management System for Dental and Medical Clinics with Location-Based Mapping</p><br>   --}}

                      <p>Appointment and Management System for Dental and Medical Clinics with Location-Based Mapping (“MR. JAMS”) owns and operates mrjams.herokuapp.com(“Website”). MR. JAMS offers various online services such as appointment and management system through the Website and the MR. JAMS mobile application (“Mobile App”).</p>

                      <p><b>1. Agreement</b></p>
                      <p>-	These Terms of Service and the Privacy Policy (collectively, this "Agreement") form a binding contract between you and MR. JAMS. By entering into this Agreement, you represent, warrant, and covenant that (i) you are duly licensed to practice medicine in the jurisdiction (the "Jurisdiction") wherein you render medical services, and (ii) you shall and render services to patients in a competent, professional, and ethical manner and in accordance with prevailing standards of practice, and otherwise act in a manner consistent with all applicable professional and ethical standards. You agree to be governed by the terms of this Agreement by registering as a clinic user ("Clinic User"). If you disagree with any portion of this Agreement, do not engage into it and do not register, utilize, or offer the MR. JAMS Services. MR. JAMS may change this Agreement at any time and for any cause. Any modifications to the terms of this Agreement will be communicated to you. Your continuing use of the Website Platform, the Mobile App, and/or provision of the MR. JAMS Services following such modifications indicates your agreement to be bound by the changes to this Agreement.</p>

                      <p><b>2. Privacy and Security</b></p>
                      <p>-	By entering and storing patients' personal information in the MR. JAMS program, you are engaging in data processing, as described in Republic Act No. 10173, often known as the Data Privacy Act, and you must follow the rules of the law. You must maintain the confidentiality of the personal information of your patients that you will process in compliance with all applicable laws and the confidentiality agreement that you and MR. JAMS have entered into. You will be held accountable for your use of MR. JAMS as well as your supply of clinical services through MR. JAMS.</p>

                      <p><b>3. Membership</b></p>
                      <p>-	To register as a clinic and use and/or deliver the MR. JAMS Services, you must have a business permit. To become a Clinic User of MR. JAMS, you must enter your clinic name, business permit number, clinic type, business permit, valid email address, and contact number. You can change your Clinic User account at any moment by going to "Settings" and then to the "General Details" section. To register as an MR. JAMS Customer User, you must submit personal information such as your name, address, gender, email address, and contact information. You can change your Customer User account at any moment by heading to "Avatar" or "Profile."</p>

                      <p><b>4. License to use MR. JAMS Services</b></p>
                      <p>-	As a registered Clinic member, MR. JAMS offers you a non-exclusive license to access and use the Website Platform, as well as use and/or deliver MR. JAMS Services to patients who register with you to acquire MR. JAMS Services. MR. JAMS offers you a non-exclusive permission to access and utilize the Website Platform and the Mobile App as a registered Customer member.</p>

                      <p><b>5. Scope of MR. JAMS Services</b></p>
                      <p>-	A registered member will have access to the following MR. JAMS Services: Use the Website Platform and Mobile App to create, input, save, access, centralize, add to, and process your patients' medical records. Be enrolled in the clinic's database and provide information about your history, specialties, schedules, and other information in your profiles, allowing patients access to such profiles; Schedule appointments with patients and be scheduled for appointments with patients on MR. JAMS;</p>

                      <p><b>6. Patient Medical Records</b></p>
                      <p>-	MR. JAMS software provides a cloud-based, digital platform via which clinics and customers can encode and save personal and medical information about their patients for future use. Patients' electronic medical records may contain the following information: name, age, address, contact numbers, email address; medical history, which includes but is not limited to: past and present illnesses; past and present medications; past and present medical procedures; and schedules of appointments with healthcare service providers registered or affiliated with MR. JAMS. The clinics' information is entirely responsible for the accuracy and completeness of the electronic medical records. MR. JAMS is not responsible for guaranteeing the accuracy and completeness of the clinic's and staff's information. As a result, MR. JAMS accepts no responsibility if any information pertaining to customers or patients is incorrect or absent.</p>

                      <p><b>7. Recovery of Patient Medical Records</b></p>
                      <p>-	In the event that the Services and Agreement are terminated, MR. JAMS will assist you in collecting your patient records in soft/digital or hard/printed form, as requested.</p>

                      <p><b>8. Confidentiality of Personal Information</b></p>
                      <p>-	Personal information about your patients that you provide through the Website Platform, Mobile App, and MR. JAMS Services is stored by MR. JAMS. Any information from which your patients' identities can be reasonably and directly determined is considered personal information. Name, address, email address, telephone number, and photos are examples of personal information. Patients' and your personal information will be saved in the MR. JAMS database, which will be kept totally confidential and not shared with anyone else.</p>

                      <p><b>9. Aggregation of Medical Data </b></p>
                      <p>-	Medical Data that you provide through the Website Platform, Mobile App, and MR. JAMS Services is collected, stored, and processed by MR. JAMS. To the extent that such Medical Data contains Personal Information or Sensitive Personal Information, this is done in accordance with Data Privacy Laws.   Medical Data information includes, but is not limited to, symptoms, test results, diagnoses, prescriptions, therapies, treatment compliance, and treatment results resulting from consultations with your patients. In terms of the clinic's stocks, they can add more of the same material as long as they indicate the expiration date, as that is what separates them. Keep in mind that the first stock to be reduced is also the first to expire. For proper monitoring, they must manage their supply appropriately. Doctors may agree to share aggregate data with the MR. JAMS Database.</p>

                      <p><b>10. Scheduling of Appointments</b></p>
                      <p>-	MR. JAMS provides a service for scheduling patient appointments that you can use. You can register for this service by indicating your clinic's hours of operation and the time windows during which patients can schedule appointments. If you avail of this service, you agree to exert reasonable effort to meet such appointments.</p>

                      <p><b>11. Interruption of Service</b></p>
                      <p>-	MR. JAMS will notify you as soon as possible if a service disruption occurs due to a power outage or a system problem that requires entire or partial network downtime, both planned and unexpected. You may rest certain that any downtime will not result in data loss or a security compromise. Any such loss or breach would be a violation of the Data Privacy Act (Republic Act No. 10703), and MR. JAMS would be required to notify you and fix the situation. MR. JAMS will provide support services to minimize or eliminate any downtime, but will not be liable for any damages resulting from the termination, loss, or interruption of the Website, Mobile App, or MR. JAMS Services, or any technical issues affecting your access to the Website, Mobile App, or MR. JAMS Services. Please phone (+63) 901 234 5678 or email mr.jams1822@gmail.com for immediate assistance.</p>

                      <p><b>12. Use of The Website, Mobile App, And Mr. Jams Services</b></p>
                      <p>-	You must not use the Website, Mobile App, or MR. JAMS Services in any way that is unlawful, fraudulent, illegal, or abusive. You undertake to indemnify, defend, and hold MR. JAMS and its directors harmless from and against any and all suits or claims arising from or related to your use of the Website, Mobile App, or MR. JAMS Services in any way.</p>

                      <p><b>13. Exclusion from Liability</b></p>
                      <p>-	MR. JAMS will not be liable for any direct, indirect, incidental, consequential, or exemplary damages, including (but not limited to) damages for loss of profits, goodwill, use, data, or other intangible losses, resulting from (but not limited to) the following: Cancellation of appointments booked through MR. JAMS; Termination of, or loss or interruption of, the Website, Mobile App, or MR. JAMS Services, or any technical problems affecting your access to the Website; Failure to give accurate and complete information about your patients, or your failure to provide accurate and complete information about your patients; and Failure to update your account information.</p>

                      <p><b>14. Contact Information</b></p>
                      <p>-	You can contact MR. JAMS at mr.jams1822@gmail.com if you have any issues concerning the Website, Mobile App, MR. JAMS Services, or this Agreement.</p>

              </div>
              

      
                {{-- <div class="row">
                    <div class="col-sm-6 login-sec">
                     
                      
                    
                       
                    </div>
                   
                    <div class="col-sm-6">
                      
                    </div>	   
                  
                </div> --}}

            </form>
      
        </div>

        <div style="text-align: center; padding-top:2%;" class="copy-text"> TUPT - BSIT 4A | 2018-2022</div>


    </section>

    
</body>
</html>