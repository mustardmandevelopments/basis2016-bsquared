/**
 * Aaron Young, Megan Palmer, Lucas Mathis, Peter Atwater, Sherri Miller
 * Bob Fisher, Kathy Pratt, James Gibbs, Tanya Ulrich, Kyle Cleven, Jason Kessler-Holt
 * Source for Navigation: http://cssmenumaker.com/
 * Source for Hashing Algorithm: http://pajhome.org.uk/crypt/md5/sha512.html
 * Source for Back-End(Tutorial):http://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL
 * Source for Login Page: http://www.24psd.com/css3-login-form-template/
 * Inspired by: http://www.noahglushien.com/
 * FAQ Source: http://www.snyderplace.com/demos/collapsible.html
 *
 * CREATIVE COMMONS- All social media link and images used fall under CC
 * http://creativecommons.org/licenses/by/3.0/legalcode
 *
 *
 *    The MIT License (MIT)

 * Copyright (c) 2016-Present b[squared]

 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:

 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */


$(document).ready(function(){
    $('form').validate({
        rules: {
            name: {
                required: true,
                minLength: 3
            },
            email: {
                required:true,
                email:true
            },
            subject: {
                required: true,
                maxLength: 50,
                minLength: 8
            },
            content: {
                required: true
            }
        },
        messages: {
            email: "Please enter a valid email address",
            name: {
                required: "You must enter your name",
                minLength: "Please enter a name longer than 3 characters"
            },
            subject: {
                required: "Please enter a subject",
                maxLength: "Please limit your subject to 50 characters.",
                minLength: "Please extend your subject to 8 characters."
            },
            content: {
                required: "Please enter something for your message."
            }
        },
        errorPlacement: function(error, element){
            if(element.is(":input")) {
                error.appendTo(element.parent.next());
            }
        },
        submitHandler: function() {
            alert("submitted");
        }

    });
});