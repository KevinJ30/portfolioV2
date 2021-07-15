import '../sass/app.scss';

import ModalCustomElement from "../CustomElements/Modal/ModalCustomElement";
import FormAddSkillCustom from "./Form/Skills/formAddSkillCustom";
import EditableItemCustomElements from "../CustomElements/EditableItem/EditableItemCustomElements";

customElements.define('editable-item', EditableItemCustomElements)
customElements.define('modal-dialog', ModalCustomElement)
customElements.define('form-add-skill', FormAddSkillCustom)

