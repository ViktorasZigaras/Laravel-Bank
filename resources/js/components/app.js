
// class AppView {

//     constructor(/*height, width*/) {
//         // this.height = height;
//         // this.width = width;

//         this.initMeth();
//     }

//     initMeth() {
//         this.drawAppInitMeth();
//     }

//     drawAppInitMeth() {
//         const appViewDOM = document.querySelector('#app');
//         appViewDOM.innerHTML = 'DOM';
//     }

// }

import { drawIndexInit } from './index';
import { drawCreateInit } from './create';

export const drawAppInit = () => {

    const listLink = document.querySelector('#listLink');
    if (listLink) {
        listLink.addEventListener("click", () => { 
            console.log('list');
            drawIndexInit();
        });
    }

    const createLink = document.querySelector('#createLink');
    if (createLink) {
        createLink.addEventListener("click", () => { 
            console.log('create');
            drawCreateInit();
        });
    }

    const contentJSDOM = document.querySelector('#contentJS');
    if (contentJSDOM) {
        contentJSDOM.innerHTML += `
            <div class="container">

                <div class="row justify-content-center">

                    <div class="col-md-10">

                        <div class="card min-width-1000">

                            <div class="header">

                                <div><img class="image" src="pictures/bank.jpg" alt="bank"></div>

                                <div class="header-text">
                                    <h2> Čiupčius and Griebčius Inc. </h2>
                                    <div> Give Us All Of Your Money NOW!!! </div>
                                </div>

                                <div><img class="image" src="pictures/money.jpg" alt="money"></div>

                            </div>

                            <div id="contentJSON"></div>

                            <div class="footer">
                                <div> Grab-All Brothers: We Love Your Money And NOT You!!! </div>
                                <div> &copy; 2020 Corona Edition </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        `;

        drawIndexInit();

    }
    
}  

/*

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            @if ($errors->any())
            <div class="alert">
                <ul class="list-group">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            @if(session()->has('success_message'))
                <div class="alert alert-success" role="alert">
                    {{session()->get('success_message')}}
                </div>
            @endif
            
            @if(session()->has('info_message'))
                <div class="alert alert-info" role="alert">
                    {{session()->get('info_message')}}
                </div>
            @endif
        </div>
    </div>
</div>

*/