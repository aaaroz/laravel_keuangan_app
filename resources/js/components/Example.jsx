import React from "react";
import ReactDOM from "react-dom/client";

function Example() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="w-full p-3 rounded border">
                        <div className="bg-fuchsia-800">
                            <h1 className="text-xl font-bold font-sans text-fuchsia-700">
                                HALO BANG, AKU RIEK KOMPONEN!
                            </h1>
                        </div>

                        <div className="card-body">
                            <p>
                                Aku adalah komponen riek yang dibuat di dalam
                                project larapel :p
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Example;

if (document.getElementById("example")) {
    const Index = ReactDOM.createRoot(document.getElementById("example"));

    Index.render(
        <React.StrictMode>
            <Example />
        </React.StrictMode>
    );
}
