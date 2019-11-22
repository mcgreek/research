import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Index extends Component {
    render() {
        return (
            <div className="content">
                <div className="card-header">Welcome to poll index page</div>

                <div className="card-body">You need to know poll link to start</div>
            </div>
        );
    }
}

if (document.getElementById('indexPage')) {
    ReactDOM.render(<Index />, document.getElementById('indexPage'));
}
