import React from 'react';
import './index.css';

class Header extends React.Component {
    render() {

        const {onAddNote, onDeleteNote} = this.props;

        return(
            <div className="header">
                <div className="title">
                    <span>simple note</span>
                </div>
                <div className="buttons">
                    <button onClick={onAddNote}>추가</button>
                    <button onClick={onDeleteNote}>삭제</button>
                </div>
            </div>
        )
    }
}

export default Header;