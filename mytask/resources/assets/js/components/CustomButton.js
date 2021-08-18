import React from 'react';

function CustomButton(props) {
    return (
        <div className={props.active == 'yes' ? 'myCustomBtn active' : 'myCustomBtn'}>
            {props.content}
        </div>
    )
}

export default CustomButton;
