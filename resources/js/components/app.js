import { drawIndexInit } from './index';
import { drawCreateInit } from './create';

export default class AppView {

    constructor() {
        this.drawAppInit();
    }

    drawAppInit() {
        
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
                <div id="errors"></div>
                <div id="messages"></div>

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
}