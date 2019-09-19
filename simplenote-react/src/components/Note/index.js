import React from 'react';
import './index.css';

class Note extends React.Component {
    render() {

        const {note, onEditNote} = this.props;
        const {title, contents} = note;

        return(
            <div className="note">
                <input
                    className="title"
                    value={title}
                    onChange={(e) => onEditNote('title', e)}
                    placeholder={'제목'}
                />
                <textarea
                    className="note-contents"
                    value={contents}
                    onChange={(e) => onEditNote('contents', e)}
                    placeholder={'내용'}
                />
            </div>
        );
    }
}

export default Note;