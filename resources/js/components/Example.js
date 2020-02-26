import React from "react";
import ReactDOM from "react-dom";

function Example() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Example Component</div>

                        <div className="card-body">
                            <form onSubmit={this.onSubmitButton}>
                                <strong>Name:</strong>
                                <input
                                    type="text"
                                    name="name"
                                    className="form-control"
                                    value={this.state.name}
                                    onChange={this.onChangeValue}
                                />
                                <strong>Description:</strong>
                                <textarea
                                    className="form-control"
                                    name="description"
                                    value={this.state.description}
                                    onChange={this.onChangeValue}
                                ></textarea>
                                <button className="btn btn-success">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Example;

if (document.getElementById("example")) {
    ReactDOM.render(<Example />, document.getElementById("example"));
}
