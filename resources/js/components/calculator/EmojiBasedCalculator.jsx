import React, { useState } from "react";
import axios from "axios";
import "./EmojiBasedCalculator.module.css";

const EmojiBasedCalculator = () => {
    const [firstOperand, setFirstOperand] = useState("");
    const [firstOperandError, setFirstOperandError] = useState("");
    const [operator, setOperator] = useState("");
    const [operatorError, setOperatorError] = useState("");
    const [secondOperand, setSecondOperand] = useState("");
    const [secondOperandError, setSecondOperandError] = useState("");
    const [APISecretKeyError, setAPISecretKeyError] = useState("");
    const [answer, setAnswer] = useState(null);

    const handleCalculation = (event) => {
        event.preventDefault();
        const postData = {
            first_operand: firstOperand,
            second_operand: secondOperand,
            operator: operator,
            api_secret_key: "secret123@API",
        };
        axios.post(`/api/calculate`, postData).then((response) => {
            setFirstOperandError("");
            setOperatorError("");
            setSecondOperandError("");
            setAPISecretKeyError("");
            setAnswer(null);
            const { success } = response.data;
            if (success) {
                const { result } = response.data;
                setAnswer(result);
            } else {
                const {
                    first_operand,
                    second_operand,
                    operator,
                    api_secret_key,
                } = response.data.errors;
                if (first_operand) {
                    setFirstOperandError(first_operand[0]);
                }
                if (second_operand) {
                    setSecondOperandError(second_operand[0]);
                }
                if (operator) {
                    setOperatorError(operator[0]);
                }
                if (api_secret_key) {
                    setAPISecretKeyError(api_secret_key[0]);
                }
            }
        });
    };

    return (
        <>
            <form>
                {APISecretKeyError && (
                    <div
                        id="api_key_error"
                        className="text-center api-error-message"
                    >
                        API ERROR: {APISecretKeyError}
                    </div>
                )}

                <label htmlFor="first_operand">
                    First Operand:{"  "}
                    {firstOperandError && (
                        <span className="error-message">
                            {firstOperandError}
                        </span>
                    )}
                </label>

                <input
                    type="text"
                    className={firstOperandError ? "error" : ""}
                    value={firstOperand}
                    placeholder="Enter First Operand"
                    onChange={(event) => setFirstOperand(event.target.value)}
                />

                <label htmlFor="operator">
                    Operator:{"  "}
                    {operatorError && (
                        <span className="error-message">{operatorError}</span>
                    )}
                </label>
                <select
                    value={operator}
                    className={operatorError ? "error" : ""}
                    onChange={(event) => setOperator(event.target.value)}
                >
                    <option value="">Select Operator</option>
                    <option value="addition">&#x1F47D; (Addition)</option>
                    <option value="subtraction">&#x1F480; (Subtraction)</option>
                    <option value="multiplication">
                        &#x1F47B; (Multiplication)
                    </option>
                    <option value="division">&#x1F631; (Division)</option>
                </select>

                <label htmlFor="second_operand">
                    Second Operand:{"  "}
                    {secondOperandError && (
                        <span className="error-message">
                            {secondOperandError}
                        </span>
                    )}
                </label>
                <input
                    type="text"
                    value={secondOperand}
                    className={secondOperandError ? "error" : ""}
                    placeholder="Enter Second Operand"
                    onChange={(event) => setSecondOperand(event.target.value)}
                />

                <input
                    type="submit"
                    value="CALCULATE"
                    onClick={(event) => handleCalculation(event)}
                />
            </form>

            <div className="text-center">
                {answer !== null && <h2>The answer is: {answer}</h2>}
            </div>
        </>
    );
};

export default EmojiBasedCalculator;
