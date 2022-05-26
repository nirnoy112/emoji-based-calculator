import React from "react";
import ReactDOM from "react-dom";
import EmojiBasedCalculator from "./calculator/EmojiBasedCalculator";
import "../../css/app.css";

const App = () => {
    return (
        <>
            <h1 className="text-center">CALCULATOR BASED ON EMOJIS</h1>
            <EmojiBasedCalculator />
        </>
    );
};

export default App;

if (document.getElementById("app")) {
    ReactDOM.render(<App />, document.getElementById("app"));
}
