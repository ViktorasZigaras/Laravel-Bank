
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

export const drawAppInit = () => {

    const listLink = document.querySelector('#listLink');
    if (listLink) {
        listLink.addEventListener("click", () => { 
            console.log('list');
        });
    }

    const createLink = document.querySelector('#createLink');
    if (createLink) {
        createLink.addEventListener("click", () => { 
            console.log('create');
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
                                    <h2>Čiupčius and Griebčius Inc.</h2>
                                    <div>Give Us All Of Your Money NOW!!!</div>
                                </div>

                                <div><img class="image" src="pictures/money.jpg" alt="money"></div>

                            </div>

                            <div id="contentJSON"></div>

                            <div class="footer">
                                <div>Grab-All Brothers: We Love Your Money And NOT You!!!</div>
                                <div>&copy; 2020 Corona Edition</div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        `;

        // axios.post('./data'
        axios.post('http://localhost/Laravel-Bank/public/accountsJS', {}).then( (response) => {  
            console.log('getting index info');

            console.log(response.data);

            const data = response.data;

            const contentJSONDOM = document.querySelector('#contentJSON');
            if (contentJSONDOM) {

                let accounts = '';

                Object.entries(data.accounts).forEach( account => {

                    account = account['1'];

                    accounts += `
                        <span>
                            ${account.account} 
                            ( ${account.personal_code} ) 
                            ${account.name} 
                            ${account.surname}: 
                            ${account.value} 
                            &euro; 
                            ${account.value * data.rate} 
                            &dollar;
                        </span>
                    `;
                });

                contentJSONDOM.innerHTML = `
                    <div class="card-header">Account List</div>

                    <div class="card-body"> ${accounts} </div>
                `;

                

                if (data.role === 'admin') {
                    //
                }
            }

                // <div class="flex">

                //     <form method="GET" action="{{route('account.edit', [$account])}}">
                //         @csrf
                //         <button type="submit">EDIT</button>
                //     </form>

                //     <form method="POST" action="{{route('account.add', [$account])}}">
                //         <button type="submit" name="add" value="add">ADD</button>
                //         @csrf
                //         <input type="text" name="value" value="0" class="list-input">
                //     </form>

                //     <form method="POST" action="{{route('account.remove', [$account])}}">
                //         <button type="submit" name="add" value="add">REMOVE</button>
                //         @csrf
                //         <input type="text" name="value" value="0" class="list-input">
                //     </form>

                //     <form method="POST" action="{{route('account.destroy', [$account])}}">
                //         @csrf
                //         <button type="submit">DELETE</button>
                //     </form>

                // </div>

        })
        .catch( (error) => {console.log(error);} );
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