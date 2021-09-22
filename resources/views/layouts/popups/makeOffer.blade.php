<!-- Make an Offer Popup
    ================================================== -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
    <!--Tabs -->
    <div class="sign-in-form">
        <ul class="popup-tabs-nav">
            <li><a href="#tab">Make an Offer</a></li>
        </ul>
        <div class="popup-tabs-container">
            <!-- Tab -->
            <div class="popup-tab-content" id="tab">
                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Discuss your project with David</h3>
                </div>
                <!-- Form -->
                <form method="post" action="#" id="makeOfferForm">
                    @csrf
                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-account-circle"></i>
                        <input type="text" class="input-text with-border" name="name" id="name"
                               placeholder="First and Last Name"/>
                    </div>

                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input type="text" class="input-text with-border" name="email" id="emailaddress"
                               placeholder="Email Address"/>
                    </div>
                    <textarea name="message" cols="10" placeholder="Message" class="with-border"></textarea>
                    <div class="uploadButton margin-top-25">
                        <input class="uploadButton-input" name="file" type="file" accept="image/*, application/pdf" id="upload"
                               multiple/>
                        <label class="uploadButton-button ripple-effect" for="upload">Add Attachments</label>
                        <span class="uploadButton-file-name">Allowed file types: zip, pdf, png, jpg <br> Max. files size: 50 MB.</span>
                    </div>
                </form>
                <!-- Button -->
                <button class="button margin-top-35 full-width button-sliding-icon ripple-effect" type="submit">Make
                    an Offer <i class="icon-material-outline-arrow-right-alt"></i></button>
            </div>
            <!-- Login -->
            <div class="popup-tab-content" id="loginn">
                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Discuss Your Project With Tom</h3>
                </div>

                <!-- Form -->
                <form method="post" id="make-an-offer-form">

                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-account-circle"></i>
                        <input type="text" class="input-text with-border" name="name2" id="name2"
                               placeholder="First and Last Name" required/>
                    </div>

                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input type="text" class="input-text with-border" name="emailaddress2" id="emailaddress2"
                               placeholder="Email Address" required/>
                    </div>

                    <textarea name="textarea" cols="10" placeholder="Message" class="with-border"></textarea>

                    <div class="uploadButton margin-top-25">
                        <input class="uploadButton-input" type="file" accept="image/*, application/pdf"
                               id="upload-cv" multiple/>
                        <label class="uploadButton-button" for="upload-cv">Add Attachments</label>
                        <span class="uploadButton-file-name">Allowed file types: zip, pdf, png, jpg <br> Max. files size: 50 MB.</span>
                    </div>
                </form>
                <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect" type="submit"
                        form="make-an-offer-form">Make an Offer <i
                        class="icon-material-outline-arrow-right-alt"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- Make an Offer Popup / End -->